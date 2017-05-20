<?php

namespace Themes\Controller;

use Themes\Controller\ThemesAppController;

class MenuController extends ThemesAppController {

    public $option_field = [
        'Menu Name' => 'name',
        'Create Date' => 'entity_create_date',
        'Status' => 'status_indicator',
        'Action' => 'action_menu'
    ];

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->params_data = $this->request->data;
        $this->params_query = $this->request->query;
        $this->loadModel('MenuDetail');
    }

    public function lists() {
        $option_field = $this->option_field;
        $this->set(compact('option_field'));
    }

    public function serverSide() {
        $this->viewBuilder()->layout(false);
        $this->render(false);
        $option['table'] = 'menu';
        $option['field'] = $this->option_field;
        $option['search'] = ['name'];
        $option['orderby'] = ['menu_id' => 'DESC'];
        $json = $this->DataTables->getResponse($option);
        echo $json;
    }

    public function setting() {
        $menu_id = isset($this->params_query['menu_id']) ? $this->params_query['menu_id'] : "";
        $listMenu = $this->MenuDetail->find()
                ->select([
                    'id' => 'md.menu_detil_id',
                    'name' => 'c.`name`',
                    'parent_id' => 'md.parent_id',
                    'drop_down' => 'md.drop_down',
                    'order_id' => 'md.order_id'
                ])
                ->from('category c')
                ->join([
                    'table' => 'menu_detail',
                    'alias' => 'md',
                    'type' => 'INNER',
                    'conditions' => 'c.category_id=md.category_id',
                ])
                ->where(['type' => 'Page', 'c.status' => 'Y', 'md.status' => 'Y', 'menu_id' => $menu_id])
                ->toArray();
        $this->set(compact('listMenu'));
    }

    public function saveMenu() {
        $item = isset($this->params_data['item']) ? $this->params_data['item'] : [];
        $menu_id = isset($this->params_data['menu_id']) ? $this->params_data['menu_id'] : null;

        if ($this->request->is('post')) {
            if (!empty($menu_id)) {
                try {
                    $menu = $this->Menu->get($menu_id);
                    $item_value = explode('|', $item);
                    $item_value = explode('|', $item);
                    $menu->value = serialize($item_value[0], $item_value[1]);
                    $this->Menu->save($menu);
                    $this->Flash->success('Menu has been saved');
                } catch (\Exception $ex) {
                    $this->Flash->error($ex);
                }
            }
        }
        die();
    }

}
