<?php

namespace Themes\Controller;

use App\Controller\AppController;

class ThemesAppController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('DataTables');
        $this->loadModel('ThemesSetting');
        $this->viewBuilder()->layout('Dashboard/dashboard');
    }

}
