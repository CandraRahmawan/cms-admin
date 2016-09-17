<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Users extends Entity {

    protected $_virtual = ['full_name', 'entity_create_date', 'entity_update_date', 'active', 'action_user'];

    protected function _getFullName() {
        return $this->_properties['first_name'] . ' ' . $this->_properties['last_name'];
    }

    protected function _getEntityCreateDate() {
        return date("d-M-Y, H:i", strtotime($this->_properties['create_date']));
    }

    protected function _getEntityUpdateDate() {
        if ($this->_properties['update_date'] == null || $this->_properties['update_date'] == '')
            return "";
        else
            return date("d-M-Y, H:i", strtotime($this->_properties['update_date']));
    }

    protected function _getActionUser() {
        return "<a href=\"" . $this->request . "profile.html?id_user=" . $this->_properties['user_id'] . "\"><i class=\"fa fa-fw fa-edit\"></i> Update </a>";
    }

    protected function _getActive() {
        if ($this->_properties['is_active'] == 'Y')
            return '<span class="label label-success">Active</span>';
        else
            return '<span class="label label-warning">Not Active</span>';
    }

}
