<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class ContentTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->table('content');
        $this->primaryKey('content_id');
        $this->belongsTo('users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('category', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
        ]);
    }

    public function getListContent()
    {
        $result = $this->find()
            ->contain(['category'])
            ->select(['content_id', 'category.name'])
            ->where(['content.status' => 'Y', 'category.type' => 'Page'])
            ->toArray();
        return $result;
    }

}
