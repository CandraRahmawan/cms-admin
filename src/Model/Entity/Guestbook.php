<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Guestbook extends Entity {

    protected $_virtual = ['send_date', 'action_guestbook'];

    protected function _getSendDate() {
        return date("d-M-Y, H:i", strtotime($this->_properties['send_date']));
    }

    protected function _getActionGuestbook() {
        return "<a href=\"" . $this->request . "read.html?guestbook_id=" . $this->_properties['guestbook_id'] . "\"><i class=\"fa fa-fw fa-check-square-o\"></i> View Detail </a>";
    }

}
