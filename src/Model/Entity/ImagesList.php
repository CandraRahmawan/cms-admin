<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;

class ImagesList extends Entity {

    protected $_virtual = ['entity_create_date', 'action_images', 'user_name', 'link'];

    protected function _getEntityCreateDate() {
        return date("d-M-Y, H:i", strtotime($this->_properties['created_date']));
    }

    protected function _getActionImages() {
        $result = "<a href=\"" . $this->request . "form-action.html?images_id=" . $this->_properties['id_images'] . "\"><i class=\"fa fa-fw fa-edit\"></i> Update </a>";
        //$result .= "<a href=\"" . $this->request . "form-action.html?images_id=" . $this->_properties['id_images'] . "\"><i class=\"fa fa-fw fa-remove\"></i> Remove </a>";
        return $result;
    }

    protected function _getUserName() {
        return $this->_properties['user']['user_name'];
    }

    protected function _getLink() {
        return Configure::read('App.baseUrlWeb') . Configure::read('urlImage.image_management') . date('Ymd', strtotime($this->_properties['created_date'])) . '/' . $this->_properties['name'];
    }

}
