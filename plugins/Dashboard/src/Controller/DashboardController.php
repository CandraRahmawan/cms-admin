<?php

namespace Dashboard\Controller;

use Cake\Mailer\Email;

class DashboardController extends DashboardAppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
    }

    public function index() {

    }

}
