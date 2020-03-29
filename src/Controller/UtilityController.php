<?php

namespace App\Controller;

use Cake\Filesystem\File;

class UtilityController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->params_data = $this->request->data;
        $this->params_query = $this->request->query;
    }

    public function deleteFiles() {
        $key = isset($this->params_data['key']) ? $this->params_data['key'] : null;

        if (!empty($key)) {
            $key = str_replace($this->base . '/', '', $key);

            $files_system = new File(WWW_ROOT . $key, false, 0777);
            if ($files_system->delete())
                die(json_encode("Success"));
            else
                die("Error Deleting Files");
        } else {
            die("Something Wrong, Try Again Later");
        }
    }

}
