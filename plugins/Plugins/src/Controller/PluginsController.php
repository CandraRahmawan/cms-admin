<?php

namespace Plugins\Controller;

class PluginsController extends PluginsAppController
{
    public $option_field = [
        'Name' => 'name',
        'Type' => 'type',
        'Description' => 'description',
        'Install Date' => 'entity_install_date',
        'Status' => 'active',
        'Action' => 'action'
    ];

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        $this->loadModel('Plugins');
        $this->loadModel('PluginsDetail');
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
        $option['table'] = 'plugins';
        $option['field'] = $this->option_field;
        $option['search'] = ['plugins.name', 'description'];
        $option['join'] = ['Themes'];
        $option['where'] = ['Themes.active' => 'Y'];
        $option['orderby'] = ['plugin_id' => 'DESC'];
        $json = $this->DataTables->getResponse($option);
        die($json);
    }

    public function formAction()
    {
        $plugin_id = $this->request->query['plugin_id'];
        $plugin = $this->Plugins->getById($plugin_id);
        if (sizeof($plugin) > 0) {
            $pluginDetail = $this->PluginsDetail->find()->where(['plugin_id' => $plugin_id])->toArray();
            $plugin = $plugin[0];
            $this->set(compact('pluginDetail', 'plugin'));
            $this->render($plugin['render_filename']);
        } else {
            $this->redirect('/');
        }
    }

    public function deletePluginDetail()
    {
        $this->viewBuilder()->layout(false);
        $this->render(false);
        if ($this->request->is('ajax') && !empty($this->request->query['id'])) {
            $entity = $this->PluginsDetail->get($this->request->query['id']);
            $this->PluginsDetail->delete($entity);
            die('ok');
        } else {
            die('failed');
        }
    }

}
