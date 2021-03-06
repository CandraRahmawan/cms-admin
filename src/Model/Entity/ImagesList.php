<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;

class ImagesList extends Entity
{

    protected $_virtual = ['entity_create_date', 'action_images', 'user_name', 'link'];

    protected function _getEntityCreateDate()
    {
      if (isset($this->_properties['created_date'])) {
        return date("d-M-Y, H:i", strtotime($this->_properties['created_date']));
      }
      return;
    }

    protected function _getActionImages()
    {
      if (isset($this->_properties['id_images'])) {
        $result = "<a href=\"" . $this->request . "delete.html?images_id=" . $this->_properties['id_images'] . "\" onclick=\"return confirm('delete this image ?')\"><i class=\"fa fa-fw fa-remove\"></i> Delete </a>";
        return $result;
      }
      return;
    }

    protected function _getUserName()
    {
      if (isset($this->_properties['user']['user_name'])) {
        return $this->_properties['user']['user_name'];
      }
      return;
    }

    protected function _getImage()
    {
        return '<img style="height:150px; width: 150px; object-fit:contain;" src=' . Configure::read('App.baseUrlWeb') . Configure::read('urlImage.image_management') . date('Ymd', strtotime($this->_properties['created_date'])) . '/' . $this->_properties['name'] . ' />';
    }

    protected function _getLink()
    {
      if (isset($this->_properties['created_date'])) {
        return Configure::read('App.baseUrlWeb') . Configure::read('urlImage.image_management') . date('Ymd', strtotime($this->_properties['created_date'])) . '/' . $this->_properties['name'];
      }
      return;
    }

}
