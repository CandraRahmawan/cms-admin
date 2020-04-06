<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Review extends Entity {
  
  protected $_virtual = ['created_date', 'action_reviews', 'entity_is_show', 'entity_created_date'];
  
  protected function _getActionReviews() {
    if (!empty($this->_properties['review_id'])) {
      $change_status = "<a href=\"" . $this->request . "review/change-status/" . $this->_properties['is_show'] . "?id=" . $this->_properties['review_id'] . "\"><i class=\"fa fa-undo\"></i> Change Status (Y/N)</a>";
      $view_review = "<a href=\"#modalReviewComment\" data-toggle=\"modal\" data-comment=\"" . $this->_properties['comment'] . "\"data-name=\"" . $this->_properties['name'] . "\" data-email=\"" . $this->_properties['email'] . "\">Comment<i class=\"fa fa-fw fa-commenting-o\"></i></a>";
      return $change_status . " | " . $view_review;
    }
    return null;
  }
  
  protected function _getEntityIsShow() {
    if (!empty($this->_properties['is_show'])) {
      if ($this->_properties['is_show'] == 'Y')
        return '<span class="label label-success">Enabled</span>';
      else
        return '<span class="label label-warning">Disabled</span>';
    }
    return null;
  }
  
  protected function _getEntityCreatedDate() {
    return !empty($this->_properties['created_date']) ? date("d-M-Y, H:i", strtotime($this->_properties['created_date'])) : null;
  }
  
}
