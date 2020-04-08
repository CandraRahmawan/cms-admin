<?php

namespace Api\Controller;

use Cake\Log\Log;
use Cake\Mailer\Email;

class ApiController extends ApiAppController {
  
  public function initialize() {
    parent::initialize();
    $this->viewBuilder()->layout(false);
    $this->render(false);
  }
  
  public function apiSendReview() {
    $this->loadModel('Reviews');
    if ($this->request->is('post') && $this->request->is('ajax')) {
      $validate_captcha = $this->__validateRecaptcha();
      if ($validate_captcha) {
        $name = $this->request->data['name'];
        $email = $this->request->data['email'];
        $phone_number = $this->request->data['phone_number'];
        $comment = $this->request->data['comment'];
        $review = $this->Reviews->newEntity();
        try {
          $review->name = $name;
          $review->email = $email;
          $review->phone_number = $phone_number;
          $review->comment = $comment;
          $this->Reviews->save($review);
          die('Success Send Review');
        } catch (\Exception $ex) {
          Log::error($ex);
          die('Failed Send Review');
        }
      } else {
        die('Access Denied');
      }
    }
  }
  
  public function apiSendMailbox() {
    $this->loadModel('Mailbox');
    if ($this->request->is('post') && $this->request->is('ajax')) {
      $validate_captcha = $this->__validateRecaptcha();
      if ($validate_captcha) {
        $themes = $this->Themes->find()->where(['active' => 'Y'])->first();
        $themes_setting = $this->ThemesSetting->find()->where(['id_theme' => $themes['id_theme'], '`key` IN' => ['is_email_send_active', 'contact_email_send_to']])->toArray();
        
        $name = $this->request->data['name'];
        $email = $this->request->data['email'];
        $phone_number = $this->request->data['phone_number'];
        $message = $this->request->data['message'];
        $mailbox = $this->Mailbox->newEntity();
        try {
          $mailbox->name = $name;
          $mailbox->email = $email;
          $mailbox->phone_number = $phone_number;
          $mailbox->message = $message;
          $this->Mailbox->save($mailbox);
          
          if ($themes_setting[1]['value_1'] == 'Y') {
            $email = new Email('default');
            $email->setViewVars([
              'title_value_1' => 'Name',
              'value_1' => $name,
              'title_value_2' => 'Email',
              'value_2' => $email,
              'title_value_3' => 'Phone Number',
              'value_3' => $phone_number,
              'title_value_4' => 'Message',
              'value_4' => $message
            ]);
            foreach (json_decode($themes_setting[0]['value_1']) as $emailTo) {
              $email->addTo($emailTo);
            }
            $email->template('default')
              ->emailFormat('html')
              ->subject(sprintf('%s Send Message to you from dbe-id.com', $name))
              ->send();
          }
          
          die('Success Send Message');
        } catch (\Exception $ex) {
          Log::error($ex);
          die('Failed Send Message');
        }
      } else {
        die('Access Denied');
      }
    }
  }
  
  private function __validateRecaptcha() {
    $secret = $this->request->data['secret'];
    $response = $this->request->data['response'];
    $validate = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $response . "");
    $response = json_decode($validate);
    if ($response->success == false || $response->success == true && $response->score <= 0.5) {
      return false;
    }
    return true;
  }
  
  public function apiGetListReview() {
    $this->loadModel('Reviews');
    if ($this->request->is('get') && $this->request->is('ajax')) {
      $limit = $this->request->query('limit');
      $page = $this->request->query('page');
      $query = $this->Reviews->find();
      $query->where(['is_show' => 'Y'])->limit($limit)->page($page)->order(['review_id' => 'DESC']);
      $result['totalCount'] = $query->count();
      $result['data'] = [];
      foreach ($query->toArray() as $index => $item) {
        $result['data'][$index] = [
          'id' => $item['review_id'],
          'name' => $item['name'],
          'comment' => $item['comment']
        ];
      }
      die(json_encode($result));
    }
  }
  
}
