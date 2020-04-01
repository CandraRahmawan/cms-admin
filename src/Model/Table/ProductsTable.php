<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ProductsTable extends Table {
  
  public function initialize(array $config) {
    parent::initialize($config);
    $this->belongsTo('Users', [
      'foreignKey' => 'user_id',
      'joinType' => 'INNER',
    ]);
    $this->belongsTo('Category', [
      'foreignKey' => 'category_id',
      'joinType' => 'INNER',
    ]);
  }
}
