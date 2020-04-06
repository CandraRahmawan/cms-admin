<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ProductsTable extends Table {
  
  public function initialize(array $config) {
    parent::initialize($config);
    $this->belongsTo('Author', [
      'foreignKey' => 'author',
      'joinType' => 'INNER',
      'className' => 'Users',
      'propertyName' => 'author'
    ]);
    $this->belongsTo('LastBy', [
      'foreignKey' => 'last_updated_by',
      'joinType' => 'LEFT',
      'className' => 'Users',
      'propertyName' => 'lastBy'
    ]);
    $this->belongsTo('Category', [
      'foreignKey' => 'category_id',
      'joinType' => 'INNER',
    ]);
  }
}
