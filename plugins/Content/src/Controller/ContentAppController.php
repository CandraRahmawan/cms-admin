<?php

namespace Content\Controller;

use App\Controller\AppController;

class ContentAppController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('Category');
        $this->loadModel('Seo');
        $this->loadComponent('DataTables');
        $this->viewBuilder()->layout('Dashboard/dashboard');
    }

}
