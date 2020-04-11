<?php

namespace Api\Controller;

use Cake\Controller\Controller;

class ApiAppController extends Controller {
  
  public function initialize() {
    parent::initialize();
    $this->loadModel('ThemesSetting');
    $this->loadModel('Themes');
    $this->viewBuilder()->layout(false);
    $this->render(false);
  }
}
