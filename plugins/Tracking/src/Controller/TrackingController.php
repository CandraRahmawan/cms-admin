<?php

namespace Tracking\Controller;

use Tracking\Controller\TrackingAppController;
use Cake\Network\Exception\NotFoundException;

class TrackingController extends TrackingAppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->loadModel('Guestcounter');
    }

    public function GuestCounter() {
        $ip_address = isset($this->request->data['ip_address']) ? $this->request->data['ip_address'] : NULL;
        $date = isset($this->request->data['date']) ? $this->request->data['date'] : NULL;
        $location = isset($this->request->data['location']) ? $this->request->data['location'] : NULL;

        if ($this->request->is('ajax')) {
            try {
                $counter = $this->Guestcounter
                        ->find()
                        ->where(['ip_addresss' => $ip_address, 'date' => $date, 'location' => $location])
                        ->first();
                $counter->hit = $counter->hit + 1;
                $this->Guestcounter->save($counter);
            } catch (\Exception $ex) {
                $this->log($ex->getMessage() . "\n");
            }
        } else {
            throw new NotFoundException();
        }
    }

}
