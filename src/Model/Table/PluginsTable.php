<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class PluginsTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);
    }

    public function getById($id)
    {
        return $this->find()->where(['plugin_id' => $id])->toList();
    }

}
