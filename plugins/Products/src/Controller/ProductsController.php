<?php

namespace Products\Controller;

use Cake\Filesystem\Folder;
use Cake\Routing\Router;
use Cake\Filesystem\File;

class ProductsController extends ProductsAppController {
  
  public $option_field = [
    'ID' => 'unique_id',
    'Product Name' => 'entity_name',
    'Created Date' => 'entity_created_date',
    'Last Update' => 'entity_updated_date',
    'Status' => 'entity_status',
    'Category' => 'entity_category_name',
    'Author' => 'entity_author',
    'Last Update By' => 'entity_user_last_update'
  ];
  
  public function beforeFilter(\Cake\Event\Event $event) {
    parent::beforeFilter($event);
    $this->loadModel('Category');
    $this->loadModel('ThemesSetting');
    $this->params_data = $this->request->data;
    $this->params_query = $this->request->query;
  }
  
  public function lists() {
    $option_field = $this->option_field;
    $this->set(compact('option_field'));
  }
  
  public function serverSide() {
    $this->viewBuilder()->layout(false);
    $this->render(false);
    $option['table'] = 'products';
    $option['field'] = $this->option_field;
    $option['search'] = ['products.name', 'products.unique_id', 'Category.name'];
    $option['join'] = ['Category', 'Author', 'LastBy'];
    $option['orderby'] = ['product_id' => 'DESC'];
    $json = $this->DataTables->getResponse($option);
    die($json);
  }
  
  public function formProduct() {
    $product_id = isset($this->params_query['product_id']) ? $this->params_query['product_id'] : null;
    
    if (empty($product_id)) {
      $product = $this->Products->newEntity();
      $type = 'add';
    } else {
      $product = $this->Products->get($product_id);
      $type = 'update';
    }
    
    if ($this->request->is('post') || $this->request->is('put')) {
      $product_id = $this->__saveItem($type, $product);
      return $this->redirect(['action' => 'formProduct', '_ext' => 'html' . '?product_id=' . $product_id . '']);
    }
    
    $list_category = $this->Category->getListCategory('product');
    $themes_setting = $this->ThemesSetting->find();
    $this->set(compact('product', 'list_category', 'themes_setting'));
  }
  
  private function __saveItem($type, $entity) {
    $name = isset($this->params_data['product_name']) ? $this->params_data['product_name'] : null;
    $subtitle = isset($this->params_data['subtitle']) ? $this->params_data['subtitle'] : null;
    $description_1 = isset($this->params_data['description_1']) ? $this->params_data['description_1'] : null;
    $description_2 = isset($this->params_data['description_2']) ? $this->params_data['description_2'] : null;
    $price = isset($this->params_data['price']) ? $this->params_data['price'] : null;
    $prefix_currency = isset($this->params_data['prefix_currency']) ? $this->params_data['prefix_currency'] : null;
    $specification = isset($this->params_data['specification']) ? $this->params_data['specification'] : null;
    $features = isset($this->params_data['features']) ? $this->params_data['features'] : [];
    $features_color = isset($this->params_data['features_color']) ? $this->params_data['features_color'] : '#fff';
    $feature_note = isset($this->params_data['feature_note']) ? $this->params_data['feature_note'] : null;
    $additional_info = isset($this->params_data['additional_info']) ? $this->params_data['additional_info'] : null;
    $status = isset($this->params_data['status']) ? $this->params_data['status'] : null;
    $category_id = isset($this->params_data['category_id']) ? $this->params_data['category_id'] : null;
    $render_template_filename = isset($this->params_data['render_template_filename']) ? $this->params_data['render_template_filename'] : null;
    
    if ($type == 'update') {
      $entity->updated_date = date('Y-m-d H:i:s');
      $entity->last_updated_by = $this->session_user['user_id'];
    } else {
      $entity->unique_id = 'P' . date('ym') . $category_id . rand(100, 999);
      $entity->author = $this->session_user['user_id'];
    }
    
    $entity->name = $name;
    $entity->subtitle = $subtitle;
    $entity->description_1 = $description_1;
    $entity->description_2 = $description_2;
    $entity->price = $price;
    $entity->prefix_currency = $prefix_currency;
    $entity->specification = $specification;
    $entity->features = json_encode($features);
    $entity->features_color = $features_color;
    $entity->feature_note = $feature_note;
    $entity->additional_info = $additional_info;
    $entity->status = $status;
    $entity->category_id = $category_id;
    $entity->render_template_filename = $render_template_filename;
    
    try {
      $insert = $this->Products->save($entity);
      if ($type == 'update') {
        $product_id = $entity->product_id;
        $this->Flash->success('Product Item Has Been Updated');
      } else {
        $product_id = $insert->product_id;
        $update = $this->Products->get($product_id);
        $update->unique_id = $insert->unique_id . $product_id;
        $this->Products->save($update);
        $this->Flash->success('Product Item Has Been Added');
      }
      return $product_id;
    } catch (\Exception $ex) {
      $this->Flash->error($ex);
      return $this->redirect(['action' => 'lists', '_ext' => 'html']);
    }
  }
  
  public function getImage() {
    $product_id = isset($this->params_query['product_id']) ? $this->params_query['product_id'] : null;
    if ($this->request->is('ajax') && !empty($product_id)) {
      $product = $this->Products->get($product_id);
      $path_images = [];
      $config = [];
      if (!empty($product->img_path)) {
        foreach (json_decode($product->img_path) as $img) {
          $path_images[] = "<img src='" . $this->base . $img . "' width='380' height='240' style='object-fit:contain;'/>'";
          $config[] = ['key' => $img, 'extra' => ['product_id' => $product_id], 'url' => Router::url(['controller' => 'Products', 'action' => 'removeImage'])];
        }
      }
      die(json_encode(['msg' => 'Success', 'items' => $path_images, 'config' => $config]));
    }
    die('failed');
  }
  
  public function uploadImage() {
    $product_id = isset($this->params_query['product_id']) ? $this->params_query['product_id'] : null;
    
    if ($this->request->is('ajax') && !empty($product_id)) {
      $file = isset($this->params_data['img_path']) ? $this->params_data['img_path'] : null;
      $entity = $this->Products->get($product_id);
      $destination_img = $this->utility->basePathImages('product') . $entity->category_id . DS . $entity->unique_id;
      
      new Folder(WWW_ROOT . $destination_img, true, 0777);
      $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
      $setNewFileName = md5(date('YmdHis') . '%' . $file['name']) . '.' . $ext;
      move_uploaded_file($file['tmp_name'], WWW_ROOT . $destination_img . DS . $setNewFileName);
      $img_list = [];
      if (!empty($entity->img_path)) {
        foreach (json_decode($entity->img_path) as $item) {
          $img_list[] = $item;
        }
      }
      array_push($img_list, $destination_img . DS . $setNewFileName);
      $entity->img_path = json_encode($img_list);
      $entity->updated_date = date('Y-m-d H:i:s');
      $entity->last_updated_by = $this->session_user['user_id'];
      $this->Products->save($entity);
      die(json_encode(['msg' => 'Success']));
    }
    die(json_encode(['msg' => 'Failed Upload Images']));
  }
  
  public function sortImage() {
    $product_id = isset($this->params_query['product_id']) ? $this->params_query['product_id'] : null;
    $sortItem = isset($this->params_query['sortItem']) ? $this->params_query['sortItem'] : null;
    
    $entity = $this->Products->get($product_id);
    $img_list = [];
    foreach ($sortItem as $item) {
      $img_list[] = $item['key'];
    }
    $entity->img_path = json_encode($img_list);
    $entity->updated_date = date('Y-m-d H:i:s');
    $entity->last_updated_by = $this->session_user['user_id'];
    $this->Products->save($entity);
    die(json_encode(['msg' => 'Sort Image Success']));
  }
  
  public function removeImage() {
    $product_id = isset($this->params_data['product_id']) ? $this->params_data['product_id'] : null;
    $key = isset($this->params_data['key']) ? $this->params_data['key'] : null;
    
    $entity = $this->Products->get($product_id);
    $dir = new Folder(WWW_ROOT . $this->utility->basePathImages('product') . $entity->category_id . DS . $entity->unique_id);
    $files_system = [];
    
    $img_list = [];
    foreach (json_decode($entity->img_path) as $item) {
      $filename_img = explode(DS, $item);
      if ($key != $item) {
        $img_list[] = $item;
      } else {
        $files_system = $dir->find(end($filename_img), true);
      }
    }
    
    if (count($files_system) > 0) {
      $file_img = new File(WWW_ROOT . $key, false, 0777);
      $file_img->delete();
    }
    
    $entity->img_path = json_encode($img_list);
    $entity->updated_date = date('Y-m-d H:i:s');
    $entity->last_updated_by = $this->session_user['user_id'];
    $this->Products->save($entity);
    die(json_encode(['msg' => 'Success']));
  }
}