<?php

namespace Content\Controller;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Inflector;
use Cake\Utility\Text;

class ContentController extends ContentAppController
{

    public $article = [
        'Title Content' => 'title',
        'Category' => 'category_name',
        'Type' => 'category_type',
        'Create' => 'entity_create_date',
        'Author' => 'user_name',
        'Status' => 'active',
        'Action' => 'action_content'
    ];
    public $page = [
        'Category' => 'category_name',
        'Type' => 'category_type',
        'Create' => 'entity_create_date',
        'Link' => 'link',
        'Author' => 'user_name',
        'Status' => 'active',
        'Action' => 'action_content'
    ];
    public $section = [
        'Category' => 'category_name',
        'Type' => 'category_type',
        'Create' => 'entity_create_date',
        'Author' => 'user_name',
        'Status' => 'active',
        'Action' => 'action_content'
    ];

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        $this->params_data = $this->request->data;
        $this->params_query = $this->request->query;
    }

    public function listsArticle()
    {
        $option_field = $this->article;
        $this->set(compact('option_field'));
    }

    public function listsPage()
    {
        $option_field = $this->page;
        $this->set(compact('option_field'));
    }

    public function listsSection()
    {
        $option_field = $this->section;
        $this->set(compact('option_field'));
    }

    public function serverSide()
    {
        $type = isset($this->request->params['pass'][0]) ? $this->request->params['pass'][0] : 'article';
        $this->viewBuilder()->layout(false);
        $this->render(false);
        $option['table'] = 'content';
        $option['search'] = ['title', 'type'];
        $option['orderby'] = ['content_id' => 'DESC'];
        $option['join'] = ['Category', 'Users'];

        if ($type == 'article') {
            $option['field'] = $this->article;
            $option['where'] = ['content.status !=' => 'T', 'Category.type' => 'Content', 'Category.status' => 'Y'];
        } else if ($type == 'page') {
            $option['field'] = $this->page;
            $option['where'] = ['content.status !=' => 'T', 'Category.type' => 'Page', 'Category.status' => 'Y'];
        } else if ($type == 'section') {
            $option['field'] = $this->section;
            $option['where'] = ['content.status !=' => 'T', 'Category.type' => 'Section', 'Category.status' => 'Y'];
        }

        $json = $this->DataTables->getResponse($option);
        die($json);
    }

    public function formArticle()
    {
        $content_id = isset($this->params_query['content_id']) ? $this->params_query['content_id'] : NULL;

        if (empty($content_id)) {
            $content = $this->Content->newEntity();
            $seo = $this->Seo->newEntity();
            $type = 'add';
            $param = '';
            $category = 'article';
        } else {
            $content = $this->Content->get($content_id);
            $seo = $this->Seo->get($content->seo_id);
            $type = 'update';
            $param = '?content_id=' . $content_id;
            $category = 'article';
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $success = $this->__save($type, $content, $seo, $category);
            if ($success) {
                return $this->redirect(['action' => 'listsArticle', '_ext' => 'html']);
            } else {
                return $this->redirect(['action' => 'form', '_ext' => 'html' . $param . '']);
            }
        }

        $list_category = $this->Category->getListCategory('content');
        $this->set(compact('content', 'list_category'));
    }

    public function formPage()
    {
        $content_id = isset($this->params_query['content_id']) ? $this->params_query['content_id'] : NULL;

        if (empty($content_id)) {
            $content = $this->Content->newEntity();
            $seo = $this->Seo->newEntity();
            $type = 'add';
            $param = '';
            $category = 'page';
        } else {
            $content = $this->Content->get($content_id);
            $seo = $this->Seo->get($content->seo_id);
            $type = 'update';
            $param = '?content_id=' . $content_id;
            $category = 'page';
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $success = $this->__save($type, $content, $seo, $category);
            if ($success) {
                return $this->redirect(['action' => 'listsPage', '_ext' => 'html']);
            } else {
                return $this->redirect(['action' => 'form', '_ext' => 'html' . $param . '']);
            }
        }

        $list_category = $this->Category->getListCategory('page');
        $this->set(compact('content', 'list_category', 'seo'));
    }

    public function formSection()
    {
        $content_id = isset($this->params_query['content_id']) ? $this->params_query['content_id'] : NULL;

        if (empty($content_id)) {
            $content = $this->Content->newEntity();
            $type = 'add';
            $param = '';
            $category = 'section';
        } else {
            $content = $this->Content->get($content_id);
            $type = 'update';
            $param = '?content_id=' . $content_id;
            $category = 'section';
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $success = $this->__save($type, $content, null, $category);
            if ($success) {
                return $this->redirect(['action' => 'listsSection', '_ext' => 'html']);
            } else {
                return $this->redirect(['action' => 'form', '_ext' => 'html' . $param . '']);
            }
        }

        $list_category = $this->Category->getListCategory('section');
        $this->set(compact('content', 'list_category'));
    }

    private function __save($type, $entity, $seoEntity, $category)
    {
        $file = isset($this->params_data['path_img']) ? $this->params_data['path_img'] : NULL;
        $title = isset($this->params_data['title']) ? $this->params_data['title'] : NULL;
        $description = isset($this->params_data['description']) ? $this->params_data['description'] : NULL;
        $meta_title = isset($this->params_data['meta_title']) ? $this->params_data['meta_title'] : NULL;
        $meta_description = isset($this->params_data['meta_description']) ? $this->params_data['meta_description'] : NULL;
        $category_id = isset($this->params_data['category_id']) ? $this->params_data['category_id'] : NULL;
        $status = isset($this->params_data['status']) ? $this->params_data['status'] : NULL;

        //picture
        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        $arr_ext = array('jpg', 'jpeg', 'png');
        $setNewFileName = md5($category_id . '%' . $title . '%' . $file['name']);
        if (in_array($ext, $arr_ext)) {
            $files_system = new File(WWW_ROOT . $this->utility->basePathImgArticle() . $category_id . '/' . $entity->picture, false, 0777);
            $files_system->delete();
            move_uploaded_file($file['tmp_name'], WWW_ROOT . $this->utility->basePathImgArticle() . $category_id . '/' . $setNewFileName . '.' . $ext);
            $path_img = $setNewFileName . '.' . $ext;
            $entity->picture = $path_img;
        } else {
            $dir = new Folder(WWW_ROOT . $this->utility->basePathImgArticle() . $category_id);
            $files_system = $dir->find($entity->picture, true);
            if (count($files_system) == 0)
                $entity->picture = '';
        }

        try {
            $entity->title = $title;
            $entity->description = $description;
            $entity->status = $status;
            $entity->category_id = $category_id;
            $entity->user_id = $this->session_user['user_id'];

            if ($type == 'update') {
                $entity->update_date = date('Y-m-d H:i:s');
                $seoEntity->updated_date = date('Y-m-d H:i:s');
            }

            $save = $this->Content->save($entity);

            //add link
            if ($category != 'section') {
                if ($category == 'page') {
                    $title = $this->Category->get($category_id)->toArray()['name'];
                } else {
                    $meta_title = Text::truncate(strip_tags($title), 250, ['ellipsis' => '', 'exact' => true, 'html' => false]);
                    $meta_description = Text::truncate(strip_tags($description), 250, ['ellipsis' => '', 'exact' => true, 'html' => false]);
                }

                $seoEntity->meta_title = $meta_title;
                $seoEntity->meta_description = $meta_description;
                $seo = $this->Seo->save($seoEntity);

                $karakter = array('-', '_', '(', ')', ',', '.', '@', '#', '$', '%', '&', '*', ';', '""', '\'\'', ' ', '  ', '\'');
                $title_generator = str_replace($karakter, '-', strtolower($title));
                $title_generator = preg_replace('/--+/', '-', $title_generator);
                $content = $this->Content->get($save->content_id);
                $content->seo_id = $seo->seo_id;
                $content->link = Inflector::dasherize('/' . $title_generator . '-' . $save->content_id . '/');
                $this->Content->save($content);
            }

            if ($type == 'add')
                $this->Flash->success('New Content Has Been Added');
            else
                $this->Flash->success('Content Has Been Update');

            return true;
        } catch (\Exception $ex) {
            $this->Flash->error($ex);
            return false;
        }
    }

    public function trashContent()
    {
        $content_id = isset($this->params_query['content_id']) ? $this->params_query['content_id'] : NULL;

        if (!empty($content_id)) {
            $content = $this->Content->get($content_id);
            $content->status = 'T';
            $content->trash_date = date('Y-m-d H:i:s');
            try {
                $this->Content->save($content);
                $this->Flash->success('Content Moved to Trash');
            } catch (\Exception $ex) {
                $this->Flash->error($ex);
            }
        } else {
            $this->Flash->error('Something Wrong, Try Again Later');
        }

        return $this->redirect(['action' => 'lists', '_ext' => 'html']);
    }

}
