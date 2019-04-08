<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;

class ImagesList extends Entity
{

    protected $_virtual = ['entity_create_date', 'action_images', 'user_name', 'link'];

    protected function _getEntityCreateDate()
    {
        return date("d-M-Y, H:i", strtotime($this->_properties['created_date']));
    }

    protected function _getActionImages()
    {
        $result = "<a href=\"" . $this->request . "delete.html?images_id=" . $this->_properties['id_images'] . "\" onclick=\"return confirm('delete this image ?')\"><i class=\"fa fa-fw fa-remove\"></i> Delete </a>";
        return $result;
    }

    protected function _getUserName()
    {
        return $this->_properties['user']['user_name'];
    }

    protected function _getImage()
    {
        return '<img style="height:150px; width: 150px; object-fit:cover;" src=' . Configure::read('App.baseUrlWeb') . Configure::read('urlImage.image_management') . date('Ymd', strtotime($this->_properties['created_date'])) . '/' . $this->_properties['name'] . ' />';
    }

    protected function _getLink()
    {
        return Configure::read('App.baseUrlWeb') . Configure::read('urlImage.image_management') . date('Ymd', strtotime($this->_properties['created_date'])) . '/' . $this->_properties['name'];
    }

}
