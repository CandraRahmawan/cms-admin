<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Theme extends Entity {

    protected $_virtual = ['action_theme', 'status_indicator', 'entity_install_date'];

    protected function _getEntityInstallDate() {
        return date("d-M-Y, H:i", strtotime($this->_properties['install_date']));
    }

    protected function _getActionTheme() {
        return "<a href=\"" . $this->request . "form-theme.html?id_theme=" . $this->_properties['id_theme'] . "\"><i class=\"fa fa-fw fa-gear\"></i> Setting </a>";
    }

    protected function _getStatusIndicator() {
        if ($this->_properties['active'] == 'Y')
            return '<span class="label label-success">Active</span>';
        else if ($this->_properties['active'] == 'N')
            return '<span class="label label-warning">Not Active</span>';
        else
            return '<span class="label label-danger">Trash</span>';
    }

}
