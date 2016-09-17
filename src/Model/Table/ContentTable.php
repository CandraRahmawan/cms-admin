<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ContentTable extends Table {

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

    public function getListCategory($type) {
        return $this->find()
                        ->where(['type LIKE' => '%' . $type . '%', 'status' => 'Y'])
                        ->toArray();
    }

}
