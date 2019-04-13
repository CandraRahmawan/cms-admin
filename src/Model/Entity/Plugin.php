<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Plugin extends Entity
{

    protected $_virtual = ['entity_install_date', 'action', 'active'];

    protected function _getEntityInstallDate()
    {
        return date("d-M-Y, H:i", strtotime($this->_properties['install_date']));
    }

    protected function _getAction()
    {
        return "<a href=\"" . $this->request . "form-action.html?plugin_id=" . $this->_properties['plugin_id'] . "\"><i class=\"fa fa-fw fa-newspaper-o\"></i> Update Content </a>";
    }

    protected function _getActive()
    {
        if ($this->_properties['is_active'] == 'Y')
            return '<span class="label label-success">Active</span>';
        else
            return '<span class="label label-warning">Not Active</span>';
    }

}
