<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Menu extends Entity {

    protected $_virtual = ['action_menu', 'status_indicator', 'entity_create_date'];

    protected function _getEntityCreateDate() {
        return date("d-M-Y, H:i", strtotime($this->_properties['create_date']));
    }

    protected function _getActionMenu() {
        return "<a href=\"" . $this->request . "setting-menu.html?menu_id=" . $this->_properties['menu_id'] . "\"><i class=\"fa fa-fw fa-gear\"></i> Setting </a>";
    }

    protected function _getStatusIndicator() {
        if ($this->_properties['is_active'] == 'Y')
            return '<span class="label label-success">Active</span>';
        else if ($this->_properties['is_active'] == 'N')
            return '<span class="label label-warning">Not Active</span>';
        else
            return '<span class="label label-danger">Trash</span>';
    }

}
