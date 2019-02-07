<?php

namespace Plugins\Controller;

use App\Controller\AppController;

class PluginsAppController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('DataTables');
        $this->viewBuilder()->layout('Dashboard/dashboard');
    }

}
