<?php

namespace Dashboard\Controller;

use Dashboard\Controller\DashboardAppController;

class DashboardController extends DashboardAppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
    }

    public function index() {
    }

}
