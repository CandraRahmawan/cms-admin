<?php

namespace App\Controller;

class LoginController extends AppController {

    public function index() {
        $this->viewBuilder()->layout('Login/login');
    }

    public function login() {
        $this->loadModel('Users');
        $this->loadComponent('Hash');

        if ($this->request->is('post')) {
            $data_login['email'] = $this->request->data('email');
            $password = $this->request->data('password');
            $data_login['password'] = $this->Hash->setPassword($password);
            $login = $this->Users->login($data_login);

            if (count([$login]) == 1) {
                if ($login['is_active'] == 'Y') {
                    $session_login['user_id'] = $login['user_id'];
                    $session_login['first_name'] = $login['first_name'];
                    $session_login['last_name'] = $login['last_name'];
                    $session_login['user_name'] = $login['user_name'];
                    $session_login['email'] = $login['email'];
                    $session_login['status'] = $login['status'];
                    $session_login['path_img'] = '/' . $this->utility->basePathImgProfile() . $login['path_img'];
                    $session_login['create_date'] = $login['create_date'];
                    $this->session->write('user_login', $session_login);
                    $this->redirect(['plugin' => 'Dashboard', 'controller' => 'Dashboard', 'action' => 'index', '_ext' => 'html']);
                } else {
                    $this->Flash->error('User is not Active, Please call Administrator');
                    $this->redirect(['action' => 'index']);
                }
            } else {
                $this->Flash->error('Login Failed, Please check username/email or password');
                $this->redirect(['action' => 'index']);
            }
        } else {
            $this->Flash->error('Submit not Allowed');
            $this->redirect(['action' => 'index']);
        }
    }

    public function logout() {
        $this->session->destroy();
        return $this->redirect(['action' => 'index']);
    }

}
