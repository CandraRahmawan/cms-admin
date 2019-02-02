<?php

namespace Users\Controller;

use Users\Controller\UsersAppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Filesystem\Folder;

class UsersController extends UsersAppController {

    public $option_field = [
        'Full Name' => 'full_name',
        'User Name' => 'user_name',
        'Email' => 'email',
        'Register' => 'entity_create_date',
        'Roles' => 'status',
        'Active' => 'active',
        'Action' => 'action_user'
    ];

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->params_data = $this->request->data;
        $this->params_query = $this->request->query;
    }

    public function profile() {
        $id_user = isset($this->params_query['id_user']) ? $this->params_query['id_user'] : '';

        if ($id_user != '') {
            $profile = $this->Users->find()
                    ->where([
                        'user_id' => $id_user
                    ])
                    ->first();

            if (count($profile) == 1) {
                $this->set(compact('profile'));
            } else {
                return $this->redirect(['plugin' => 'Dashboard', 'controller' => 'Dashboard', 'action' => 'index']);
            }
        } else {
            throw new NotFoundException();
        }
    }

    public function submitProfile() {
        if ($this->request->is('post')) {
            $user_id = isset($this->params_data['user_id']) ? $this->params_data['user_id'] : NULL;
            $save = $this->Users->get($user_id);
            $this->__saveUser('update', $save);
        } else {
            return $this->redirect(['plugin' => 'Dashboard', 'controller' => 'Dashboard', 'action' => 'index']);
        }
        return $this->redirect(['action' => 'profile', '_ext' => 'html?id_user=' . $user_id . '']);
    }

    public function lists() {
        $option_field = $this->option_field;
        $this->set(compact('option_field'));
    }

    public function serverSide() {
        $this->viewBuilder()->layout(false);
        $this->render(false);
        $option['table'] = 'users';
        $option['field'] = $this->option_field;
        $option['search'] = ['user_name', 'email', 'status', 'first_name', 'last_name', 'CONCAT (first_name ," ", last_name)'];
        $option['orderby'] = ['user_id' => 'DESC'];
        $json = $this->DataTables->getResponse($option);
        echo $json;
    }

    public function add() {
        $users = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $success = $this->__saveUser('add', $users);
            if ($success) {
                return $this->redirect(['action' => 'lists', '_ext' => 'html']);
            } else {
                return $this->redirect(['action' => 'add', '_ext' => 'html']);
            }
        }
        $this->set(compact('users'));
    }

    private function __saveUser($type, $entity) {
        $file = isset($this->params_data['path_img']) ? $this->params_data['path_img'] : NULL;
        $user_name = isset($this->params_data['user_name']) ? $this->params_data['user_name'] : NULL;
        $email = isset($this->params_data['email']) ? $this->params_data['email'] : NULL;
        $first_name = isset($this->params_data['first_name']) ? $this->params_data['first_name'] : NULL;
        $last_name = isset($this->params_data['last_name']) ? $this->params_data['last_name'] : NULL;
        $password = isset($this->params_data['password']) ? $this->params_data['password'] : NULL;
        $is_active = isset($this->params_data['is_active']) ? $this->params_data['is_active'] : NULL;
        $status = isset($this->params_data['status']) ? $this->params_data['status'] : NULL;
        $user_id = isset($this->params_data['user_id']) ? $this->params_data['user_id'] : NULL;

        //picture
        new Folder(WWW_ROOT . $this->utility->basePathImgProfile(), true, 0777);
        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        $arr_ext = array('jpg', 'jpeg', 'png');
        $setNewFileName = md5($email . '%' . $user_name);
        if (in_array($ext, $arr_ext)) {
            move_uploaded_file($file['tmp_name'], WWW_ROOT . $this->utility->basePathImgProfile() . $setNewFileName . '.' . $ext);
            $path_img = $setNewFileName . '.' . $ext;
            $entity->path_img = $path_img;
            $this->session_user['path_img'] = '/' . $this->utility->basePathImgProfile() . $path_img;
        } else {
            $dir = new Folder(WWW_ROOT . $this->utility->basePathImgProfile());
            $files_system = $dir->find($entity->path_img, true);
            if (count($files_system) == 0)
                $entity->path_img = '';
        }

        if ($password != "") {
            $entity->password = $this->Hash->setPassword($password);
        }

        if ($type == 'update') {
            $entity->update_date = date('Y-m-d H:i:s');
        } else {
            $entity->create_date = date('Y-m-d H:i:s');
        }

        $entity->user_name = strtolower($user_name);
        $entity->first_name = $first_name;
        $entity->last_name = $last_name;
        $entity->is_active = $is_active;
        $entity->email = $email;
        $entity->status = $status;

        $this->session_user['first_name'] = $first_name;
        $this->session_user['last_name'] = $last_name;
        $this->session_user['user_name'] = $user_name;

        try {
            $this->Users->save($entity);
            if ($type == 'update') {
                $this->Flash->success('Profile Has Been Updated');
                if ($this->session_user['user_id'] == $user_id)
                    $this->session->write('user_login', $this->session_user);
            } else {
                $this->Flash->success('New User Has Been Added');
            }
            return true;
        } catch (\Exception $ex) {
            $this->Flash->error($ex);
            return $this->redirect(['action' => 'lists', '_ext' => 'html']);
        }
    }

    public function cekValidationExistingUser() {
        $this->viewBuilder()->layout = false;
        $this->render(false);

        $params = isset($this->params_data['params']) ? $this->params_data['params'] : "";
        $type = isset($this->params_data['type']) ? $this->params_data['type'] : "";
        $email = isset($this->params_data['email']) ? $this->params_data['email'] : "";
        $user_name = isset($this->params_data['user_name']) ? $this->params_data['user_name'] : "";
        $user_id = isset($this->params_data['user_id']) ? $this->params_data['user_id'] : "";

        $query = $this->Users->find()
                ->where(['user_id' => $user_id]);

        if ($query->count() == 1) {
            $query = $query->toArray();
            $user_name = $query[0]['user_name'];
            $email = $query[0]['email'];
        }

        if ($email != '')
            $request_name = 'Email';
        else
            $request_name = 'Username';

        if ($this->request->is('post')) {
            $result = 'true';
            if ($type == 'add') {
                $query = $this->Users->find()
                        ->where(['user_name' => $params])
                        ->orWhere(['email' => $params]);
                if ($query->count() == 1)
                    $result = 'That ' . $request_name . ' is already taken';
            } else {
                $query = $this->Users->find()
                        ->where(['user_name' => $params, 'user_name != ' => $user_name])
                        ->orWhere(['email' => $params, 'email != ' => $email]);
                if ($query->count() == 1)
                    $result = 'That ' . $request_name . ' is already taken';
            }
            echo json_encode($result);
        }
        die;
    }

}
