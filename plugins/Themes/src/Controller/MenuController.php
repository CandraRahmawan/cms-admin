<?php

namespace Themes\Controller;

use Cake\Utility\Hash;

class MenuController extends ThemesAppController
{

    public $option_field = [
        'Menu Name' => 'name',
        'Create Date' => 'entity_create_date',
        'Status' => 'status_indicator',
        'Action' => 'action_menu'
    ];

    public $option_field_detail = [
        'Menu Name' => 'name',
        'Order' => 'order_id',
        'Created Date' => 'entity_create_date',
        'Link Url' => 'link_url',
        'Status' => 'status_indicator',
        'Action' => 'action'
    ];

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        $this->params_data = $this->request->data;
        $this->params_query = $this->request->query;
        $this->loadModel('MenuDetail');
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
        $option['table'] = 'menu';
        $option['field'] = $this->option_field;
        $option['search'] = ['name'];
        $option['orderby'] = ['menu_id' => 'DESC'];
        $json = $this->DataTables->getResponse($option);
        echo $json;
    }

    public function serverSideDetail()
    {
        $this->viewBuilder()->layout(false);
        $this->render(false);
        $option['table'] = 'menu_detail';
        $option['field'] = $this->option_field_detail;
        $option['search'] = ['name'];
        $option['orderby'] = ['order_id' => 'ASC'];
        $json = $this->DataTables->getResponse($option);
        echo $json;
    }


    public function setting()
    {
        $menu_id = isset($this->params_query['menu_id']) ? $this->params_query['menu_id'] : "";

        if ($this->request->is('post') || $this->request->is('put')) {
            $param = '?menu_id=' . $menu_id;
            $success = $this->__saveMenuDetail();
            if ($success) {
                return $this->redirect(['action' => 'lists', '_ext' => 'html']);
            } else {
                return $this->redirect(['action' => 'setting', '_ext' => 'html' . $param . '']);
            }
        }

        $listMenuByContent = $this->MenuDetail->find()
            ->select([
                'id' => 'md.menu_detail_id',
                'name' => 'md.name',
                'parent_id' => 'md.parent_id',
                'drop_down' => 'md.drop_down',
                'order_id' => 'md.order_id',
                'status' => 'md.status',
                'created_date' => 'md.created_date'
            ])
            ->from('content c')
            ->join([
                'table' => 'menu_detail',
                'alias' => 'md',
                'type' => 'INNER',
                'conditions' => 'c.content_id=md.content_id',
            ])
            ->where(['c.status' => 'Y', 'md.status' => 'Y', 'menu_id' => $menu_id])
            ->toArray();
        $listMenuCustom = $this->MenuDetail->find()
            ->select([
                'id' => 'md.menu_detail_id',
                'name' => 'md.name',
                'parent_id' => 'md.parent_id',
                'drop_down' => 'md.drop_down',
                'order_id' => 'md.order_id',
                'status' => 'md.status',
                'created_date' => 'md.created_date'
            ])
            ->from('menu m')
            ->join([
                'table' => 'menu_detail',
                'alias' => 'md',
                'type' => 'INNER',
                'conditions' => 'm.menu_id=md.menu_id',
            ])
            ->where(['md.status' => 'Y', 'm.menu_id' => $menu_id, 'md.content_id' => 0])
            ->toArray();
        $listMenu = Hash::sort(Hash::merge($listMenuByContent, $listMenuCustom), '{n}.order_id', 'asc');
        $this->set(compact('listMenu', 'menuDetail'));
    }

    public function detailUpdate()
    {
        $option_field = $this->option_field_detail;
        $this->set(compact('option_field'));
    }

    private function __saveMenuDetail()
    {
        $sortValue = isset($this->params_data['sort_value']) ? $this->params_data['sort_value'] : [];
        if (!empty($sortValue)) {
            $explodeSortValue = explode(',', $sortValue);
            try {
                foreach ($explodeSortValue as $key => $item) {
                    $menuDetail = $this->MenuDetail->get($item);
                    $menuDetail->order_id = $key + 1;
                    $this->MenuDetail->save($menuDetail);
                }
                $this->Flash->success('Menu Detail has been saved');
            } catch (\Exception $ex) {
                $this->Flash->error($ex);
                return false;
            }
        } else {
            $this->Flash->success('Menu Detail has been saved');
        }
        return true;
    }

    public function changeStatus()
    {
        $status = $this->request->params['status'];
        $menu_id = $this->request->query['menu_id'];
        $detail_id = $this->request->query['detail_id'];
        $menuDetail = $this->MenuDetail->get($detail_id);
        $menuDetail->status = $status == 'Y' ? 'N' : 'Y';
        try {
            $this->MenuDetail->save($menuDetail);
            $this->Flash->success('Status Menu Detail has been updated');
        } catch (\Exception $ex) {
            $this->Flash->error($ex);
            return false;
        }
        return $this->redirect(['action' => 'detail_update', '_ext' => 'html' . '?menu_id=' . $menu_id]);
    }

}
