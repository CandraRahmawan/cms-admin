<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Content extends Entity {

    protected $_virtual = ['entity_create_date', 'entity_update_date', 'action_content', 'user_name', 'category_name', 'category_type', 'active'];

    protected function _getEntityCreateDate() {
        return date("d-M-Y, H:i", strtotime($this->_properties['create_date']));
    }

    protected function _getEntityUpdateDate() {
        if ($this->_properties['update_date'] == null || $this->_properties['update_date'] == '')
            return "";
        else
            return date("d-M-Y, H:i", strtotime($this->_properties['update_date']));
    }

    protected function _getActionContent() {
        if ($this->_properties['category']['type'] == 'Page')
            return "<a href=\"" . $this->request . "form-page.html?content_id=" . $this->_properties['content_id'] . "\"><i class=\"fa fa-fw fa-edit\"></i> Update </a> | <a href=\"" . $this->request . "trash.html?content_id=" . $this->_properties['content_id'] . "\" onclick=\"return confirm('Are you sure to Move Trash ?')\"><i class=\"fa fa-fw fa-trash\"></i> Trash </a>";
        else if ($this->_properties['category']['type'] == 'Content')
            return "<a href=\"" . $this->request . "form-article.html?content_id=" . $this->_properties['content_id'] . "\"><i class=\"fa fa-fw fa-edit\"></i> Update </a> | <a href=\"" . $this->request . "trash.html?content_id=" . $this->_properties['content_id'] . "\" onclick=\"return confirm('Are you sure to Move Trash ?')\"><i class=\"fa fa-fw fa-trash\"></i> Trash </a>";
    }

    protected function _getUserName() {
        return $this->_properties['user']['user_name'];
    }

    protected function _getCategoryName() {
        return $this->_properties['category']['name'];
    }

    protected function _getCategoryType() {
        return $this->_properties['category']['type'];
    }

    protected function _getActive() {
        if ($this->_properties['status'] == 'Y')
            return '<span class="label label-success">Active</span>';
        else if ($this->_properties['status'] == 'T')
            return '<span class="label label-danger">Trash</span>';
        else
            return '<span class="label label-warning">Not Active</span>';
    }

}
