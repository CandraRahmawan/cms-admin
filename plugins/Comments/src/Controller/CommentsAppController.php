<?php

namespace Comments\Controller;

use App\Controller\AppController;

class CommentsAppController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('DataTables');
        $this->viewBuilder()->layout('Dashboard/dashboard');
    }

}
