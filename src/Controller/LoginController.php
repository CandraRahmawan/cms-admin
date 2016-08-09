<?php

namespace App\Controller;

class LoginController extends AppController {

    public function index() {
        //$articles = TableRegistry::get('Users');
        debug($this->Users);die;
        $this->viewBuilder()->layout('Login/login');
    }

}
