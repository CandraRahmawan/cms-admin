<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class CategoryTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->table('category');
        $this->primaryKey('category_id');
    }

    public function getListCategory($params) {
        $result = $this->find()
                ->where(['type LIKE' => '%' . $params . '%', '`status`' => 'Y']);
        return $result;
    }

}
