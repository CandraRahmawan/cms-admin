<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Controller\Component\CommonHelperComponent;
use Cake\Utility\Text;

class Mailbox extends Entity {
  
  protected $_virtual = ['entity_name', 'entity_send_date', 'action_mailbox', 'entity_message'];
  
  protected function _getEntityName() {
    return "<a href=\"" . $this->request . "mailbox/read.html?mailbox_id=" . $this->_properties['mailbox_id'] . "\" title='Read Mail'>" . $this->_properties['name'] . "</a>";
  }
  
  protected function _getEntitySendDate() {
    return CommonHelperComponent::getTimeAgo($this->_properties['send_date']);
  }
  
  protected function _getActionMailbox() {
    return "<a href=\"" . $this->request . "mailbox/remove.html?mailbox_id=" . $this->_properties['mailbox_id'] . "\" onclick=\"return confirm('Confirm Remove MailBox : " . $this->_properties['name'] . "')\" title='Remove Mail'><i class=\"fa fa-fw fa-trash\"></i></a>";
  }
  
  protected function _getEntityMessage() {
    return Text::truncate(
      $this->_properties['message'],
      100,
      [
        'ellipsis' => '...',
        'exact' => false
      ]
    );
  }
  
}
