<?php

namespace Comments\Controller;

class ReviewsController extends CommentsAppController
{

    public $option_field = [
        'ID' => 'review_id',
        'Name' => 'name',
        'Email' => 'email',
        'Phone Number' => 'phone_number',
        'Create Date' => 'created_date',
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
        $status = $this->request->params['status'];
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

}
