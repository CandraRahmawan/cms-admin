<?php

namespace Message\Controller;

use App\Controller\AppController;

class MessageAppController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('DataTables');
        $this->viewBuilder()->layout('Dashboard/dashboard');
    }

}
