<?php

namespace Images\Controller;

use App\Controller\AppController as BaseController;

class ImagesAppController extends BaseController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('DataTables');
        $this->viewBuilder()->layout('Dashboard/dashboard');
    }

}
