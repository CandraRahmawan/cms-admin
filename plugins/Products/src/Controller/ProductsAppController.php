<?php

namespace Products\Controller;

use App\Controller\AppController;

class ProductsAppController extends AppController {
  
  public function initialize() {
    parent::initialize();
    $this->loadComponent('DataTables');
    $this->viewBuilder()->layout('Dashboard/dashboard');
  }
}
