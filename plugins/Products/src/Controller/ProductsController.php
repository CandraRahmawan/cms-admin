<?php

namespace Products\Controller;

use Cake\Filesystem\Folder;

class ProductsController extends ProductsAppController {
  
  public $option_field = [
    'ID' => 'unique_id',
    'Product Name' => 'entity_name',
    'Created Date' => 'entity_created_date',
    'Currency' => 'prefix_currency',
    'Price' => 'price',
    'Status' => 'entity_status',
    'Category' => 'entity_category_name',
    'Author' => 'entity_author'
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
    $option['search'] = ['products.name', 'subtitle'];
    $option['join'] = ['Category', 'Users'];
    $option['orderby'] = ['product_id' => 'DESC'];
    $json = $this->DataTables->getResponse($option);
    die($json);
  }
  
  public function formProduct() {
    $product_id = isset($this->params_query['product_id']) ? $this->params_query['product_id'] : null;
    
    if (empty($product_id)) {
      $product = $this->Products->newEntity();
      $param = '';
      $type = 'add';
    } else {
      $product = $this->Products->get($product_id);
      $type = 'update';
      $param = '?product_id=' . $product_id;
    }
    
    if ($this->request->is('post') || $this->request->is('put')) {
      $success = $this->__saveItem($type, $product);
      if ($success) {
        return $this->redirect(['action' => 'lists', '_ext' => 'html']);
      } else {
        return $this->redirect(['action' => 'add', '_ext' => 'html' . $param . '']);
      }
    }
    
    $list_category = $this->Category->getListCategory('product');
    $list_themes_setting = $this->ThemesSetting->getListMultipleSelect('filename_product_template');
    $this->set(compact('product', 'list_category', 'list_themes_setting'));
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
    
    if ($type == 'update') {
      $entity->update_date = date('Y-m-d H:i:s');
    } else {
      $entity->unique_id = 'P' . date('ym') . $category_id . rand(100, 999);
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
    $entity->user_id = $this->session_user['user_id'];
    $entity->render_template_filename = 'template_3';
    
    try {
      $insert = $this->Products->save($entity);
      if ($type == 'update') {
        $this->Flash->success('Product Item Has Been Updated');
      } else {
        $product_id = $insert->product_id;
        $update = $this->Products->get($product_id);
        $update->unique_id = $insert->unique_id . $product_id;
        $this->Products->save($update);
        $this->Flash->success('Product Item Has Been Added');
      }
      return true;
    } catch (\Exception $ex) {
      $this->Flash->error($ex);
      return $this->redirect(['action' => 'lists', '_ext' => 'html']);
    }
  }
}