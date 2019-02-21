<?php

namespace Users\Controller;

use App\Controller\AppController;

class UsersAppController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Hash');
        $this->loadComponent('DataTables');
        $this->viewBuilder()->layout('Dashboard/dashboard');
    }

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
    }

    protected function authUser()
    {
        if ($this->session_user['status'] != 'Administrator')
            return $this->redirect(['plugin' => 'Dashboard', 'controller' => 'Dashboard', 'action' => 'index']);
    }

}
