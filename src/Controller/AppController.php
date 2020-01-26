<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;
use App\View\Helper\UtilityHelper;

class AppController extends Controller {
  
  public $session;
  public $session_user;
  public $base;
  public $baseWebroot;
  public $utility;
  public $params_data;
  public $params_query;
  
  public function initialize() {
    parent::initialize();
    $this->loadComponent('Flash');
    $this->loadModel('Guestbook');
    $this->loadModel('Guestcounter');
    $this->utility = new UtilityHelper(new \Cake\View\View());
    $this->session = $this->request->session();
    $this->session_user = $this->session->read('user_login');
    $this->base = Configure::read('App.baseUrlWeb');
    $this->set('session', $this->session);
    $this->set('session_user', $this->session_user);
    $this->set('base', $this->base);
    $this->set('baseWebroot', $this->request->base);
  }
  
  public function beforeRender(Event $event) {
    parent::beforeRender($event);
  }
  
  public function beforeFilter(Event $event) {
    parent::beforeFilter($event);
    
    if (empty($this->session_user)) {
      if ($this->name != 'Login' && $this->request->param('action') != 'logout') {
        return $this->redirect(['plugin' => null, 'controller' => 'Login', 'action' => 'index']);
      }
    } else {
      if ($this->name == 'Login' && $this->request->param('action') != 'logout') {
        return $this->redirect(['plugin' => 'Dashboard', 'controller' => 'Dashboard', 'action' => 'index']);
      }
    }
    
    $query_guestcounter = $this->Guestcounter->find();
    $query_guestcounter->select(['hit' => $query_guestcounter->func()->sum('hit')]);
    $count_guestcounter = $query_guestcounter->toArray()[0]->hit;
    $global_guestbook = $this->Guestbook->find()->where(['read_msg' => 'N']);
    $this->set(compact('global_guestbook', 'count_guestcounter'));
  }
  
}
