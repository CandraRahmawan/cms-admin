<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

class MenuDetail extends Entity
{
    protected $_virtual = ['status_indicator', 'entity_create_date'];

    protected function _getEntityCreateDate()
    {
        return !empty($this->_properties['created_date']) ? date("d-M-Y, H:i", strtotime($this->_properties['created_date'])) : null;
    }

    protected function _getStatusIndicator()
    {
        if(!empty($this->_properties['status'])) {
            if ($this->_properties['status'] == 'Y')
                return '<span class="label label-success">Active</span>';
            else if ($this->_properties['status'] == 'N')
                return '<span class="label label-warning">Not Active</span>';
            else
                return '<span class="label label-danger">Trash</span>';
        }
        return null;
    }

    protected function _getLinkUrl()
    {
        $content = TableRegistry::get('content');
        $link = $content->find()
            ->select('link')
            ->from('content')
            ->where(['content_id' => $this->_properties['content_id']])
            ->first();
        return empty($link) ? $this->_properties['custom_link'] : $link['link'];
    }

    protected function _getAction()
    {
        $changeStatus = "<a href=\"" . $this->request . "change-status/" . $this->_properties['status'] . "?detail_id=" . $this->_properties['menu_detail_id'] . "&menu_id=" . $this->_properties['menu_id'] . "\"><i class=\"fa fa-undo\"></i> Change Status (Y/N) </a>";
        $update = "<a href=\"" . $this->request . "form-menu-detail?id=" . $this->_properties['menu_detail_id'] . "&menu_id=" . $this->_properties['menu_id'] . "\"><i class=\"fa fa-edit\"></i> Update </a>";;
        return $changeStatus . " | " . $update;
    }

}
