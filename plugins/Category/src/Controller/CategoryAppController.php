<?php

namespace Category\Controller;

use App\Controller\AppController;

class CategoryAppController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('DataTables');
        $this->viewBuilder()->layout('Dashboard/dashboard');
    }

}
