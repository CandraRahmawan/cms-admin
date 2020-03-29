<?php

namespace Message\Controller;

use Message\Controller\MessageAppController;

class MailboxController extends MessageAppController
{

    public $option_field = [
        'Name' => 'entity_name',
        'Message' => 'message',
        'Send Date' => 'entity_send_date',
        'Action' => 'action_mailbox',
        'Read' => 'is_read'
    ];

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        $this->loadModel('Mailbox');
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
        $option['table'] = 'mailbox';
        $option['field'] = $this->option_field;
        $option['where'] = ['mailbox.status' => 'A'];
        $option['search'] = ['name', 'email'];
        $option['orderby'] = ['mailbox_id' => 'DESC'];
        $json = $this->DataTables->getResponse($option);
        die($json);
    }

    public function read()
    {
        $mailbox_id = isset($this->params_query['mailbox_id']) ? $this->params_query['mailbox_id'] : "";

        if ($mailbox_id != "") {
            $mailbox = $this->Mailbox->get($mailbox_id);
            if ($mailbox->is_read == 'N') {
                $mailbox->is_read = 'Y';
                $mailbox->read_date = date('Y-m-d H:i:s');
                $this->Mailbox->save($mailbox);
            }
            $this->set(compact('mailbox'));
        } else {
            return $this->redirect(['action' => 'lists', '_ext' => 'html']);
        }
    }

    public function remove()
    {
        $mailbox_id = isset($this->params_query['mailbox_id']) ? $this->params_query['mailbox_id'] : "";
        try {
            $mailbox = $this->Mailbox->get($mailbox_id);
            $mailbox->status = 'T';
            $mailbox->status_update_date = date('Y-m-d H:i:s');
            $this->Mailbox->save($mailbox);
            $this->Flash->success('Mailbox has been removed');
        } catch (\Exception $ex) {
            $this->Flash->error($ex);
            return false;
        }
        return $this->redirect(['action' => 'lists', '_ext' => 'html']);
    }

}
