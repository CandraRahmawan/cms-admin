<?php

namespace Plugins\Controller;

class PluginsController extends PluginsAppController {
  public $option_field = [
    'Name' => 'name',
    'Type' => 'type',
    'Description' => 'description',
    'Install Date' => 'entity_install_date',
    'Status' => 'active',
    'Action' => 'action'
  ];
  
  public function beforeFilter(\Cake\Event\Event $event) {
    parent::beforeFilter($event);
    $this->loadModel('Plugins');
    $this->loadModel('PluginsDetail');
    $this->loadModel('Products');
  }
  
  public function lists() {
    $option_field = $this->option_field;
    $this->set(compact('option_field'));
  }
  
  public function serverSide() {
    $this->viewBuilder()->layout(false);
    $this->render(false);
    $option['table'] = 'plugins';
    $option['field'] = $this->option_field;
    $option['search'] = ['plugins.name', 'description'];
    $option['join'] = ['Themes'];
    $option['where'] = ['Themes.active' => 'Y'];
    $option['orderby'] = ['plugin_id' => 'DESC'];
    $json = $this->DataTables->getResponse($option);
    die($json);
  }
  
  public function formAction() {
    $plugin_id = $this->request->query['plugin_id'];
    $plugin = $this->Plugins->getById($plugin_id);
    if (sizeof($plugin) > 0) {
      $products = [];
      $pluginDetail = $this->PluginsDetail->find()->where(['plugin_id' => $plugin_id])->toArray();
      $plugin = $plugin[0];
  
      if ($plugin['key'] == 'download_driver') {
        $products = $this->Products->find()->where(['link_download is not' => null])->toArray();
      }
      
      $this->set(compact('pluginDetail', 'plugin', 'products'));
      $this->render($plugin['render_filename']);
    } else {
      $this->redirect('/');
    }
  }
  
  public function deletePluginDetail() {
    $this->viewBuilder()->layout(false);
    $this->render(false);
    $id = $this->request->query['id'];
    if ($this->request->is('ajax') && !empty($id)) {
      $entity = $this->PluginsDetail->get($id);
      $this->PluginsDetail->delete($entity);
      die('ok');
    } else {
      die('failed');
    }
  }
  
  public function getCategoryList() {
    $this->viewBuilder()->layout(false);
    $this->render(false);
    $type = $this->request->query['type'];
    if ($this->request->is('ajax') && !empty($type)) {
      $this->loadModel('Category');
      $list_category = $this->Category->getListCategory($type);
      die(json_encode($list_category));
    } else {
      die('failed');
    }
  }
  
}
