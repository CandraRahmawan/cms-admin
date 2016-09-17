<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class MessageTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->belongsTo('Users', [
            'foreignKey' => 'send_by',
            'joinType' => 'INNER',
        ]);
    }

}
