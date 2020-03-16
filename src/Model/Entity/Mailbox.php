<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Controller\Component\CommonHelperComponent;

class Mailbox extends Entity
{

    protected $_virtual = ['entity_name', 'send_date', 'action_mailbox'];

    protected function _getEntityName()
    {
        return "<a href=\"" . $this->request . "mailbox/read.html?mailbox_id=" . $this->_properties['mailbox_id'] . "\" title='Read Mail'>" . $this->_properties['name'] . "</a>";
    }

    protected function _getSendDate()
    {
        return CommonHelperComponent::getTimeAgo($this->_properties['send_date']);
    }

    protected function _getActionMailbox()
    {
        return "<a href=\"" . $this->request . "mailbox/remove.html?mailbox_id=" . $this->_properties['mailbox_id'] . "\" onclick=\"return confirm('Confirm Remove MailBox : " . $this->_properties['name'] . "')\" title='Remove Mail'><i class=\"fa fa-fw fa-trash\"></i></a>";
    }

}
