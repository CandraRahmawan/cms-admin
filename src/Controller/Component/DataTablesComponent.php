<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class DataTablesComponent extends Component {

    public function getResponse($option) {
        $draw = isset($this->request->query['draw']) ? $this->request->query['draw'] : 1;
        $search = isset($this->request->query['search']['value']) ? $this->request->query['search']['value'] : "*";
        $start = isset($this->request->query['start']) ? $this->request->query['start'] : 0;
        $length = isset($this->request->query['length']) ? $this->request->query['length'] : 10;
        $column = isset($this->request->query['columns']) ? $this->request->query['columns'] : NULL;
        $model = TableRegistry::get($option['table']);
        $query = $model->find();

        if (!empty($option['join'])) {
            $query->contain($option['join']);
        }

        if (!empty($option['where'])) {
            $query->where($option['where']);
        }

        $data['draw'] = $draw;
        $data['recordsTotal'] = $query->count();

        $query->limit($length)
            ->offset($start);

        if (!empty($option['join'])) {
            $query->contain($option['join']);
        }

        if (!empty($option['search'])) {
            $this->__search($option['search'], $query, $search);
        }

        if (!empty($option['where'])) {
            $query->Andwhere($option['where']);
        }

        if (!empty($option['orderby'])) {
            $query->order($option['orderby']);
        }

        if (!empty($option['field'])) {
            $result = $this->__field($option['field'], $query);
        } else {
            $result = $query->toArray();
        }

        $data['recordsFiltered'] = $query->count();
        $data['data'] = $result;
        return json_encode($data);
    }

    private function __field($field, $query) {
        $result = array();
        foreach ($query->toArray() as $nums => $item) {
            for ($i = 0; $i < count($field); $i++) {
                $key = array_keys($field)[$i];
                $value = $field[$key];
                $result[$nums][$i] = $item[$value];
            }
        }
        return $result;
    }

    private function __search($op_search, $query, $search) {
        $num = 0;
        foreach ($op_search as $item) {
            if ($num == 0)
                $query->where(['' . $item . ' LIKE' => '%' . $search . '%']);
            else
                $query->orWhere(['' . $item . ' LIKE' => '%' . $search . '%']);
            $num++;
        }
    }

}
