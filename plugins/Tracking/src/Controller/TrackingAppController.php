<?php

namespace Tracking\Controller;

use App\Controller\AppController;

class TrackingAppController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->viewBuilder()->layout(false);
        $this->render(false);
    }

}
