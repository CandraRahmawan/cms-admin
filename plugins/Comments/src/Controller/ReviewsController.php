<?php

namespace Comments\Controller;

use Comments\Controller\CommentsAppController;

class ReviewsController extends CommentsAppController
{

    public $option_field = [
        'ID' => 'review_id',
        'Name' => 'name',
        'Email' => 'email',
        'Phone Number' => 'phone_number',
        'Create Date' => 'entity_created_date',
        'Status' => 'entity_is_show',
        'Action' => 'action_reviews'
    ];

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        $this->loadModel('Reviews');
        $this->params_data = $this->request->data;
        $this->params_query = $this->request->query;
    }

    public function lists()
    {
        $option_field = $this->option_field;
        $this->set(compact('option_field'));
    }

    public function serverSide()
    {
        $this->viewBuilder()->layout(false);
        $this->render(false);
        $option['table'] = 'reviews';
        $option['field'] = $this->option_field;
        $option['search'] = ['name', 'email'];
        $option['orderby'] = ['review_id' => 'DESC'];
        $json = $this->DataTables->getResponse($option);
        echo $json;
    }

    public function changeStatus()
    {
        $status = $this->params_data['status'];
        $id = $this->params_query['id'];
        $reviews = $this->Reviews->get($id);
        $reviews->is_show = $status == 'Y' ? 'N' : 'Y';
        try {
            $this->Reviews->save($reviews);
            $this->Flash->success('Reviews Status has been updated');
        } catch (\Exception $ex) {
            $this->Flash->error($ex);
            return false;
        }
        return $this->redirect(['action' => 'lists', '_ext' => 'html']);
    }

    public function apiSendReview()
    {
        $this->viewBuilder()->layout(false);
        $this->render(false);
        if ($this->request->is('post') && $this->request->is('ajax')) {
            $name = $this->params_data['name'];
            $email = $this->params_data['email'];
            $phone_number = $this->params_data['phone_number'];
            $comment = $this->params_data['comment'];
            $review = $this->Reviews->newEntity();
            try {
                $review->name = $name;
                $review->email = $email;
                $review->phone_number = $phone_number;
                $review->comment = $comment;
                $this->Reviews->save($review);
                echo 'Success Send Review';
            } catch (\Exception $ex) {
                echo 'Failed Send Review';
            }
        }
    }

}
