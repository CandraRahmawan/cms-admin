<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ThemesSettingTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->table('themes_setting');
        $this->primaryKey('id_theme');
    }

}
