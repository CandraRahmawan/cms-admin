<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class MenuDetailTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->table('menu_detail');
        $this->primaryKey('menu_detil_id');
    }

    public function getListCategory($params) {
        $result = $this->find()
                ->where(['type LIKE' => '%' . $params . '%', '`status`' => 'Y']);
        return $result;
    }

}
