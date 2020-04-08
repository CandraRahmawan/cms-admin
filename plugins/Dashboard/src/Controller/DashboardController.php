<?php

namespace Dashboard\Controller;

use Cake\Mailer\Email;

class DashboardController extends DashboardAppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
    }

    public function index() {

    }
    
    public function testEmail() {
      $this->render(false);
      $email = new Email('default');
      $email->from(['noreply@dbe-id.com' => 'My Site'])
        ->to('candra.assasin@gmail.com')
        ->subject('About')
        ->send('My message');
    }

}
