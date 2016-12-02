<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ThemesTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->table('themes');
    }

}
