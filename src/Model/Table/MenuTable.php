<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class MenuTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->table('menu');
        $this->primaryKey('menu_id');
    }

}
