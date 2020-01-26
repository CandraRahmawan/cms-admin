<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Gallery extends Entity {

    protected $_virtual = ['entity_create_date', 'action_slider', 'user_name', 'category_name', 'active'];

    protected function _getEntityCreateDate() {
      if (isset($this->_properties['create_date'])) {
        return date("d-M-Y, H:i", strtotime($this->_properties['create_date']));
      }
      return;
    }

    protected function _getActionSlider() {
      if (isset($this->_properties['gallery_id'])) {
        return "<a href=\"" . $this->request . "form-action.html?gallery_id=" . $this->_properties['gallery_id'] . "\"><i class=\"fa fa-fw fa-edit\"></i> Update </a>";
      }
      return;
    }

    protected function _getUserName() {
      if (isset($this->_properties['user']['user_name'])) {
        return $this->_properties['user']['user_name'];
      }
      return;
    }

    protected function _getCategoryName() {
      if (isset($this->_properties['category']['name'])) {
        return $this->_properties['category']['name'];
      }
    }

    protected function _getActive() {
        if (isset($this->_properties['is_active']) && $this->_properties['is_active'] == 'Y')
            return '<span class="label label-success">Active</span>';
        else
            return '<span class="label label-warning">Not Active</span>';
    }

}
