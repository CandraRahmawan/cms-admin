<?php

namespace Gallery\Controller;

use App\Controller\AppController;

class GalleryAppController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('DataTables');
        $this->viewBuilder()->layout('Dashboard/dashboard');
    }

}
