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
        $this->loadModel('Category');
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
        $listPage = $this->Category->find()
                ->where(['type' => 'Page', 'status' => 'Y'])
                ->toArray();
        $menuPage = $this->Menu->find()
                ->where(['is_active' => 'Y', 'menu_id' => $menu_id])
                ->toArray();
        $this->set(compact('listPage', 'menuPage'));
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
