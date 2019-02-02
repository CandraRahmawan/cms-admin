<?php

namespace Gallery\Controller;

use Gallery\Controller\GalleryAppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

class SliderBannerController extends GalleryAppController {

    public $option_field = [
        'Title' => 'title',
        'link' => 'link',
        'Category' => 'category_name',
        'Create' => 'entity_create_date',
        'Author' => 'user_name',
        'Status' => 'active',
        'Action' => 'action_slider'];

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->loadModel('Gallery');
        $this->loadModel('Category');
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
        $option['table'] = 'gallery';
        $option['field'] = $this->option_field;
        $option['search'] = ['title', 'link'];
        $option['orderby'] = ['gallery_id' => 'DESC'];
        $option['join'] = ['Category', 'Users'];
        $json = $this->DataTables->getResponse($option);
        echo $json;
    }

    public function form() {
        $gallery_id = isset($this->params_query['gallery_id']) ? $this->params_query['gallery_id'] : NULL;

        if (empty($gallery_id)) {
            $sliderBanner = $this->Gallery->newEntity();
            $type = 'add';
            $param = '';
        } else {
            $sliderBanner = $this->Gallery->get($gallery_id);
            $type = 'update';
            $param = '?gallery_id=' . $gallery_id;
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $success = $this->__save($type, $sliderBanner);
            if ($success) {
                return $this->redirect(['action' => 'lists', '_ext' => 'html']);
            } else {
                return $this->redirect(['action' => 'form', '_ext' => 'html' . $param . '']);
            }
        }

        $list_category = $this->Category->getListCategory('slider banner');

        $this->set(compact('sliderBanner', 'list_category'));
    }

    private function __save($type, $entity) {
        $file = isset($this->params_data['img_user']) ? $this->params_data['img_user'] : NULL;
        $title = isset($this->params_data['title']) ? $this->params_data['title'] : NULL;
        $description = isset($this->params_data['description']) ? $this->params_data['description'] : NULL;
        $category_id = isset($this->params_data['category_id']) ? $this->params_data['category_id'] : NULL;
        $is_active = isset($this->params_data['is_active']) ? $this->params_data['is_active'] : NULL;
        $link = isset($this->params_data['link']) ? $this->params_data['link'] : '#';

        //picture
        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        $arr_ext = array('jpg', 'jpeg', 'png');
        $setNewFileName = md5($category_id . '%' . $title . '%' . $file['name']);
        if (in_array($ext, $arr_ext)) {
            $files_system = new File(WWW_ROOT . $this->utility->basePathImgSliderBanner() . $category_id . '/' . $entity->path, false, 0777);
            $files_system->delete();
            move_uploaded_file($file['tmp_name'], WWW_ROOT . $this->utility->basePathImgSliderBanner() . $category_id . '/' . $setNewFileName . '.' . $ext);
            $path_img = $setNewFileName . '.' . $ext;
            $entity->path = $path_img;
        } else {
            $dir = new Folder(WWW_ROOT . $this->utility->basePathImgSliderBanner() . $category_id);
            $files_system = $dir->find($entity->path, true);
            if (count($files_system) == 0)
                $entity->path = '';
        }

        try {

            $entity->title = $title;
            $entity->description = $description;
            $entity->category_id = $category_id;
            $entity->is_active = $is_active;
            $entity->link = $link;
            $entity->user_id = $this->session_user['user_id'];

            if ($type == 'add')
                $entity->create_date = date('Y-m-d H:i:s');
            else
                $entity->update_date = date('Y-m-d H:i:s');

            $this->Gallery->save($entity);

            if ($type == 'add')
                $this->Flash->success('Slider Banner Has Been Added');
            else
                $this->Flash->success('Slider Banner Has Been Update');

            return true;
        } catch (\Exception $ex) {
            $this->Flash->error($ex);
            return false;
        }
    }

}
