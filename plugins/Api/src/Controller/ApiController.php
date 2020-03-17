<?php

namespace Api\Controller;

class ApiController extends ApiAppController
{

    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout(false);
        $this->render(false);
    }

    public function apiSendReview()
    {
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
                    echo 'Success Send Review';
                } catch (\Exception $ex) {
                    echo 'Failed Send Review';
                }
            } else {
                echo 'Access Denied';
            }
        }
    }

    public function apiSendMailbox()
    {
        $this->loadModel('Mailbox');
        if ($this->request->is('post') && $this->request->is('ajax')) {
            $validate_captcha = $this->__validateRecaptcha();
            if ($validate_captcha) {
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
                    echo 'Success Send Message';
                } catch (\Exception $ex) {
                    echo 'Failed Send Message';
                }
            } else {
                echo 'Access Denied';
            }
        }
    }

    private function __validateRecaptcha()
    {
        $secret = $this->request->data['secret'];
        $response = $this->request->data['response'];
        $validate = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $response . "");
        $response = json_decode($validate);
        if ($response->success == false || $response->success == true && $response->score <= 0.5) {
            return false;
        }
        return true;
    }

}
