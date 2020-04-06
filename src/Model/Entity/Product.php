<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Controller\Component\CommonHelperComponent;

class Product extends Entity {
  
  protected $_virtual = ['entity_name', 'entity_created_date', 'entity_updated_date', 'entity_status', 'entity_category_name', 'entity_author', 'entity_user_last_update'];
  
  protected function _getEntityName() {
    return "<a href=\"" . $this->request . "form-product.html?product_id=" . $this->_properties['product_id'] . "\" title='Update Item'>" . $this->_properties['name'] . "</a>";
  }
  
  protected function _getEntityCreatedDate() {
    return !empty($this->_properties['created_date']) ? date("d-M-Y, H:i", strtotime($this->_properties['created_date'])) : null;
  }
  
  protected function _getEntityUpdatedDate() {
    return !empty($this->_properties['updated_date']) ? CommonHelperComponent::getTimeAgo($this->_properties['updated_date']) : null;
  }
  
  protected function _getEntityStatus() {
    if (!empty($this->_properties['status'])) {
      if ($this->_properties['status'] == 'Y')
        return '<span class="label label-success">Enabled</span>';
      else
        return '<span class="label label-warning">Disabled</span>';
    }
    return null;
  }
  
  protected function _getEntityCategoryName() {
    return $this->_properties['category']['name'];
  }
  
  protected function _getEntityAuthor() {
    return $this->_properties['author']['user_name'];
  }
  
  protected function _getEntityUserLastUpdate() {
    return $this->_properties['lastBy']['user_name'];
  }
  
}