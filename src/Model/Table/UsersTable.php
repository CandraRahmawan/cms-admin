<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class UsersTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->entityClass('App\Model\Entity\Users');
        $this->table('users');
        $this->primaryKey('user_id');
    }

    public function login($data) {
        $result = $this->find()
                ->where([
                    'password' => $data['password'],
                    'OR' => [['email' => $data['email']], ['user_name' => $data['email']]]
                ])
                ->first();
        return $result;
    }

}
