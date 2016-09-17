<?php

namespace Message\Controller;

use Message\Controller\MessageAppController;
use Cake\Mailer\Email;

class GuestbookController extends MessageAppController {

    public $option_field = [
        'Full Name' => 'full_name',
        'Email' => 'email',
        'Subject' => 'subject',
        'Send' => 'send_date',
        'Read' => 'read_msg',
        'Action' => 'action_guestbook'
    ];

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->loadModel('Guestbook');
        $this->loadModel('Message');
        $this->params_data = $this->request->data;
        $this->params_query = $this->request->query;
    }

    public function lists() {
        $option_field = $this->option_field;
        $this->set(compact('option_field'));
    }

    public function serverSide() {
        $this->viewBuilder()->layout(false);
        $this->render(false);
        $option['table'] = 'guestbook';
        $option['field'] = $this->option_field;
        $option['search'] = ['full_name', 'email', 'subject', 'message'];
        $option['orderby'] = ['guestbook_id' => 'DESC'];
        $json = $this->DataTables->getResponse($option);
        echo $json;
    }

    public function read() {
        $guestbook_id = isset($this->params_query['guestbook_id']) ? $this->params_query['guestbook_id'] : "";

        if ($guestbook_id != "") {
            $guestbook = $this->Guestbook->get($guestbook_id);
            $reply_msg = $this->Message->find()
                    ->contain(['Users'])
                    ->Where(['guestbook_id' => $guestbook_id]);
            $this->__saveGuestbook($guestbook, 'read');
            $this->set(compact('guestbook', 'reply_msg'));
        } else {
            return $this->redirect(['action' => 'lists', '_ext' => 'html']);
        }
    }

    public function reply() {
        $guestbook_id = isset($this->params_query['guestbook_id']) ? $this->params_query['guestbook_id'] : "";
        if ($guestbook_id != "") {
            $guestbook = $this->Guestbook->get($guestbook_id);
            $this->set(compact('guestbook'));
        } else {
            return $this->redirect(['action' => 'lists', '_ext' => 'html']);
        }
    }

    public function sumbitReply() {
        $guestbook_id = isset($this->params_data['guestbook_id']) ? $this->params_data['guestbook_id'] : "";
        $guestbook = $this->Guestbook->get($guestbook_id);
        $save = $this->__saveGuestbook($guestbook, 'reply');

        if ($save)
            return $this->redirect(['action' => 'lists', '_ext' => 'html']);
    }

    private function __saveGuestbook($entity, $type) {

        $data = $this->params_data;
        $to_msg = isset($data['to_msg']) ? $data['to_msg'] : null;
        $subject = isset($data['subject']) ? $data['subject'] : null;
        $message = isset($data['message']) ? $data['message'] : null;
        $guestbook_id = isset($data['guestbook_id']) ? $data['guestbook_id'] : "";

        try {

            if ($type == 'read') {
                if ($entity->read_msg == 'N') {
                    $entity->read_msg = 'Y';
                    $entity->read_by = $this->session_user['user_id'];
                    $entity->read_date = date("Y-m-d H:i:s");
                }
                $this->Guestbook->save($entity);
            } else {
                $email = new Email('default');
                $msg = $this->Message->newEntity();
                $msg->from_msg = 'candra.assasin@gmail.com';
                $msg->to_msg = $to_msg;
                $msg->subject = $subject;
                $msg->message = $message;
                $msg->send_date = date("Y-m-d H:i:s");
                $msg->send_by = $this->session_user['user_id'];
                $msg->guestbook_id = $guestbook_id;
                $this->Message->save($msg);

                //save email
                $email->to([$to_msg => $to_msg])
                        ->subject($subject)
                        ->emailFormat('html')
                        ->send($message);
                $this->Flash->success('Sending Success');
            }
            return true;
        } catch (\Exception $ex) {
            $this->Flash->error($ex);
            if ($type == 'read')
                return $this->redirect(['action' => 'read', '_ext' => 'html']);
            else
                return $this->redirect(['action' => 'reply', '_ext' => 'html']);
        }
    }

}
