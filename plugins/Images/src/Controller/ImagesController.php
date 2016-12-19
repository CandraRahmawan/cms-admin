<?php

namespace Images\Controller;

use Images\Controller\ImagesAppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

class ImagesController extends ImagesAppController {

    public $option_field = [
        'Link' => 'link',
        'Created Date' => 'entity_create_date',
        'Author' => 'user_name',
        'Action' => 'action_images'];

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->loadModel('ImagesList');
        $this->loadModel('Users');
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
        $option['table'] = 'images_list';
        $option['field'] = $this->option_field;
        $option['search'] = ['name'];
        $option['orderby'] = ['id_images' => 'DESC'];
        $option['join'] = ['Users'];
        $json = $this->DataTables->getResponse($option);
        echo $json;
    }

    public function form() {
        $images_id = isset($this->params_query['images_id']) ? $this->params_query['images_id'] : NULL;

        if (empty($images_id)) {
            $images = $this->ImagesList->newEntity();
            $type = 'add';
            $param = '';
        } else {
            $images = $this->ImagesList->get($images_id);
            $type = 'update';
            $param = '?images_id=' . $images_id;
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $success = $this->__save($type, $images);
            if ($success) {
                return $this->redirect(['action' => 'lists', '_ext' => 'html']);
            } else {
                return $this->redirect(['action' => 'form', '_ext' => 'html' . $param . '']);
            }
        }

        $this->set(compact('images'));
    }

    private function __save($type, $entity) {
        $file = isset($this->params_data['img_user']) ? $this->params_data['img_user'] : NULL;

        //picture
        $dir = new Folder(WWW_ROOT . $this->utility->basePathImages() . date('Ymd'), true, 0777);
        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        $arr_ext = array('jpg', 'jpeg', 'png');
        $setNewFileName = md5(date('YmdHis') . '%' . $file['name']);
        if (in_array($ext, $arr_ext) && ($type == 'add')) {
            $files_system = new File(WWW_ROOT . $this->utility->basePathImages() . date('Ymd') . '/' . $entity->name, false, 0777);
            $files_system->delete();
            move_uploaded_file($file['tmp_name'], WWW_ROOT . $this->utility->basePathImages() . date('Ymd') . '/' . $setNewFileName . '.' . $ext);
            $path_img = $setNewFileName . '.' . $ext;
            $entity->name = $path_img;
        } else {
            $dir = new Folder(WWW_ROOT . $this->utility->basePathImages() . date('Ymd', strtotime($entity->created_date)));
            $files_system = $dir->find($entity->name, true);

            if (count($files_system) > 0) {
                $file_img = new File(WWW_ROOT . $this->utility->basePathImages() . date('Ymd', strtotime($entity->created_date)) . '/' . $entity->name, false, 0777);
                $file_img->delete();
            }

            $files_system = new File(WWW_ROOT . $this->utility->basePathImages() . date('Ymd', strtotime($entity->created_date)) . '/' . $entity->name, false, 0777);
            move_uploaded_file($file['tmp_name'], WWW_ROOT . $this->utility->basePathImages() . date('Ymd', strtotime($entity->created_date)) . '/' . $setNewFileName . '.' . $ext);
        }

        try {

            $entity->name = $setNewFileName . '.' . $ext;
            $entity->user_id = $this->session_user['user_id'];

            if ($type == 'add')
                $entity->created_date = date('Y-m-d H:i:s');
            else
                $entity->updated_date = date('Y-m-d H:i:s');

            $this->ImagesList->save($entity);

            if ($type == 'add')
                $this->Flash->success('Upload Images Success');
            else
                $this->Flash->success('Update Images Success');

            return true;
        } catch (\Exception $ex) {
            $this->Flash->error($ex);
            return false;
        }
    }

}
