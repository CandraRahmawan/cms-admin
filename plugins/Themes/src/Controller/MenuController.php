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
        $this->loadModel('Content');
        $this->loadModel('Seo');
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
        die($json);
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
        die($json);
    }


    public function setting()
    {
        $menu_id = isset($this->params_query['menu_id']) ? $this->params_query['menu_id'] : "";

        if ($this->request->is('post') || $this->request->is('put')) {
            $param = '?menu_id=' . $menu_id;
            $success = $this->__saveSortDetail();
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
        if (!empty($menuDetail)) {
            $this->set(compact('listMenu', 'menuDetail'));
        } else {
            $this->set(compact('listMenu', []));
        }
    }

    public function detail()
    {
        $option_field = $this->option_field_detail;
        $this->set(compact('option_field'));
    }

    public function formDetail()
    {
        $menu_detail_id = isset($this->params_query['id']) ? $this->params_query['id'] : NULL;
        $menu_id = isset($this->params_query['menu_id']) ? $this->params_query['menu_id'] : NULL;
        $param = '?menu_id=' . $menu_id;
        $seo = null;
        if (empty($menu_detail_id)) {
            $menu_detail = $this->MenuDetail->newEntity();
            $seo = $this->Seo->newEntity();
            $type = 'add';
        } else {
            $menu_detail = $this->MenuDetail->get($menu_detail_id);
            if ($menu_detail->content_id == 0) {
                $seo = $this->Seo->get($menu_detail->seo_id);
            }
            $type = 'update';
            $param = $param . '&id=' . $menu_detail_id;
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $success = $this->__saveDetail($type, $menu_detail, $seo);
            if ($success) {
                return $this->redirect(['action' => 'detail', '_ext' => 'html' . $param . '']);
            } else {
                return $this->redirect(['action' => 'formDetail', '_ext' => 'html' . $param . '']);
            }
        }

        $list_content = $this->Content->getListContent();
        $this->set(compact('list_content', 'menu_detail', 'seo'));
    }

    private function __saveDetail($type, $entity, $seoEntity)
    {
        $menu_id = isset($this->params_data['menu_id']) ? $this->params_data['menu_id'] : NULL;
        $name = isset($this->params_data['name']) ? $this->params_data['name'] : NULL;
        $content_id = isset($this->params_data['content_id']) ? $this->params_data['content_id'] : 0;
        $custom_link = isset($this->params_data['custom_link']) ? $this->params_data['custom_link'] : NULL;
        $meta_title = isset($this->params_data['meta_title']) ? $this->params_data['meta_title'] : NULL;
        $meta_description = isset($this->params_data['meta_description']) ? $this->params_data['meta_description'] : NULL;
        $status = isset($this->params_data['status']) ? $this->params_data['status'] : NULL;

        try {
            $custom_link_trailing_slash = substr($custom_link, -1) == '/' ? $custom_link : $custom_link . '/';
            $custom_link_trailing_slash = substr($custom_link_trailing_slash, 0, 1) != '/' ? '/' . $custom_link_trailing_slash : $custom_link_trailing_slash;
            $entity->menu_id = $menu_id;
            $entity->name = $name;
            if (is_int($content_id)) {
                $entity->content_id = $content_id;
            } else {
                $entity->custom_link = $custom_link_trailing_slash;
            }
            $entity->status = $status;

            if ($type == 'update') {
                $entity->update_date = date('Y-m-d H:i:s');
                if (!empty($seoEntity)) {
                    $seoEntity->updated_date = date('Y-m-d H:i:s');
                }
            } else {
                $entity->order_id = 1;
            }

            if (!empty($seoEntity) && $entity->content_id == 0) {
                $seoEntity->meta_title = $meta_title;
                $seoEntity->meta_description = $meta_description;
                $seo = $this->Seo->save($seoEntity);
                $entity->seo_id = $seo->seo_id;
            }

            $this->MenuDetail->save($entity);

            if ($type == 'add')
                $this->Flash->success('Menu Detail Has Been Added');
            else
                $this->Flash->success('Menu Detail Has Been Update');

            return true;
        } catch (\Exception $ex) {
            $this->Flash->error($ex);
            return false;
        }
    }

    private function __saveSortDetail()
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
        return $this->redirect(['action' => 'detail', '_ext' => 'html' . '?menu_id=' . $menu_id]);
    }

}
