<?php

namespace Category\Controller;

use Category\Controller\CategoryAppController;
use Cake\Filesystem\Folder;

class CategoryController extends CategoryAppController {

    public $option_field = [
        'Category' => 'name',
        'Type Category' => 'type',
        'Description' => 'description',
        'Status' => 'status_indicator',
        'Action' => 'action_category'
    ];

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
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
        $option['table'] = 'category';
        $option['field'] = $this->option_field;
        $option['search'] = ['name', 'type', 'status', 'description'];
        $option['orderby'] = ['category_id' => 'DESC'];
        $json = $this->DataTables->getResponse($option);
        echo $json;
    }

    public function form() {
        $category_id = isset($this->params_query['category_id']) ? $this->params_query['category_id'] : NULL;

        if (empty($category_id)) {
            $category = $this->Category->newEntity();
            $type = 'add';
            $param = '';
        } else {
            $category = $this->Category->get($category_id);
            $type = 'update';
            $param = '?category_id=' . $category_id;
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $success = $this->__save($type, $category);
            if ($success) {
                return $this->redirect(['action' => 'lists', '_ext' => 'html']);
            } else {
                return $this->redirect(['action' => 'form', '_ext' => 'html' . $param . '']);
            }
        }

        $this->set(compact('category'));
    }

    private function __save($type, $entity) {
        $name = isset($this->params_data['name']) ? $this->params_data['name'] : NULL;
        $description = isset($this->params_data['description']) ? $this->params_data['description'] : NULL;
        $status = isset($this->params_data['status']) ? $this->params_data['status'] : NULL;
        $type_page = isset($this->params_data['type']) ? $this->params_data['type'] : NULL;

        try {

            $entity->name = $name;
            $entity->description = $description;
            $entity->status = $status;
            $entity->type = $type_page;

            if ($type == 'add')
                $entity->create_date = date('Y-m-d H:i:s');
            else
                $entity->update_date = date('Y-m-d H:i:s');

            $save = $this->Category->save($entity);
            $category_id = $save->category_id;

            if ($type_page == 'Content')
                $dir = new Folder(WWW_ROOT . 'img/Content/Article/' . $category_id . '', true, 0777);
            else if ($type_page == 'Slider Banner')
                $dir = new Folder(WWW_ROOT . 'img/Gallery/SliderBanner/' . $category_id . '', true, 0777);
            else if ($type_page == 'Gallery')
                $dir = new Folder(WWW_ROOT . 'img/Gallery/Photos/' . $category_id . '', true, 0777);


            if ($type == 'add')
                $this->Flash->success('New Category Has Been Added');
            else
                $this->Flash->success('Category Has Been Update');

            return true;
        } catch (\Exception $ex) {
            $this->Flash->error($ex);
            return false;
        }
    }

}
