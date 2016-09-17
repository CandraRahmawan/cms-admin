<?php

namespace Dashboard\Controller;

use App\Controller\AppController;

class DashboardAppController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->viewBuilder()->layout('Dashboard/dashboard');
    }

}
