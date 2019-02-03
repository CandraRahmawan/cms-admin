<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ContentTable extends Table
{

    public function initialize(array $config)
    {
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

    public function getListContent()
    {
        $result = $this->find()
            ->contain(['Category'])
            ->select(['content_id', 'category.name'])
            ->where(['content.status' => 'Y', 'category.type' => 'Page'])
            ->toArray();
        return $result;
    }

}
