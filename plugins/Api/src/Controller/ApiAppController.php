<?php

namespace Api\Controller;

use Cake\Controller\Controller;

class ApiAppController extends Controller
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Reviews');
        $this->viewBuilder()->layout(false);
        $this->render(false);
    }

    public function apiSendReview()
    {
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
