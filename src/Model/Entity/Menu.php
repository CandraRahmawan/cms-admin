<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Category extends Entity {

    protected $_virtual = ['action_category', 'status_indicator'];

    protected function _getActionCategory() {
        return "<a href=\"" . $this->request . "form-category.html?category_id=" . $this->_properties['category_id'] . "\"><i class=\"fa fa-fw fa-edit\"></i> Update </a>";
    }

    protected function _getStatusIndicator() {
        if ($this->_properties['status'] == 'Y')
            return '<span class="label label-success">Active</span>';
        else if ($this->_properties['status'] == 'N')
            return '<span class="label label-warning">Not Active</span>';
        else
            return '<span class="label label-danger">Trash</span>';
    }

}
