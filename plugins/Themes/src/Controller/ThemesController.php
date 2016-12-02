<?php

namespace Themes\Controller;

use Themes\Controller\ThemesAppController;
use Cake\Utility\Hash;

class ThemesController extends ThemesAppController {

    public $option_field = [
        'Theme Name' => 'name',
        'Install Date' => 'entity_install_date',
        'Status' => 'status_indicator',
        'Action' => 'action_theme'
    ];

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->loadModel('Menu');
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
        $option['table'] = 'themes';
        $option['field'] = $this->option_field;
        $option['search'] = ['name'];
        $option['orderby'] = ['id_theme' => 'DESC'];
        $json = $this->DataTables->getResponse($option);
        echo $json;
    }

    public function form() {
        $id_theme = isset($this->params_query['id_theme']) ? $this->params_query['id_theme'] : $this->params_data['id_theme'];

        if (!empty($id_theme)) {
            $theme = $this->ThemesSetting->find('all')
                    ->where(['id_theme' => $id_theme])
                    ->order(['`group`'])
                    ->toArray();
            $param = '?id_theme=' . $id_theme;
        }

        $menuPage = $this->Menu->find()
                ->where(['is_active' => 'Y'])
                ->toArray();
        $menuPage = Hash::combine($menuPage, '{n}.menu_id', '{n}.name');

        if ($this->request->is('post') || $this->request->is('put')) {
            $success = $this->__save($id_theme);
            if ($success) {
                return $this->redirect(['action' => 'lists', '_ext' => 'html']);
            } else {
                return $this->redirect(['action' => 'form', '_ext' => 'html' . $param . '']);
            }
        }
        $this->set(compact('theme', 'menuPage'));
    }

    private function __save($id_theme) {

        try {
            for ($i = 0; $i < count($this->params_data); $i++) {
                $key = array_keys($this->params_data)[$i];
                if ('id_theme' != $key) {
                    $this->ThemesSetting->updateAll(['value_1' => $this->params_data[$key]], ['`key`' => $key, 'id_theme' => $id_theme]);
                }
            }
            $this->Flash->success('Success Update Theme');
            return true;
        } catch (\Exception $ex) {
            $this->Flash->error($ex);
            return false;
        }
    }

}
