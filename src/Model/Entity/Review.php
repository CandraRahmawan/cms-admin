<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Review extends Entity
{

    protected $_virtual = ['entity_created_date', 'action_reviews', 'entity_is_show'];

    protected function _getEntityCreatedDate()
    {
        return date("d-M-Y, H:i", strtotime($this->_properties['created_date']));
    }

    protected function _getActionReviews()
    {
        $change_status = "<a href=\"" . $this->request . "change-status/" . $this->_properties['is_show'] . "?id=" . $this->_properties['review_id'] . "\" onclick=\"return confirm('Confirm Changes Status ID = " . $this->_properties['review_id'] . "')\"><i class=\"fa fa-undo\"></i> Change Status (Y/N)</a>";
        return $change_status . " | <a href=\"#modalReviewComment\" data-toggle=\"modal\" data-comment=\"" . $this->_properties['comment'] . "\">Comment
<i class=\"fa fa-fw fa-commenting-o\"></i></a>";
    }

    protected function _getEntityIsShow()
    {
        if (!empty($this->_properties['is_show'])) {
            if ($this->_properties['is_show'] == 'Y')
                return '<span class="label label-success">Enabled</span>';
            else
                return '<span class="label label-warning">Disabled</span>';
        }
        return null;
    }

}
