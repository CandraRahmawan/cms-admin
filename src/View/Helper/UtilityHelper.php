<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Datasource\ConnectionManager;

class UtilityHelper extends Helper {

    public function basePathImgProfile() {
        $base = 'img/Users/Profiles/';
        return $base;
    }

    public function basePathImgArticle() {
        $base = 'img/Content/Article/';
        return $base;
    }

    public function basePathImgSliderBanner() {
        $base = 'img/Gallery/SliderBanner/';
        return $base;
    }

    public function enumValue($table, $field) {
        $conn = ConnectionManager::get('default');
        $cols = $conn->execute("SHOW COLUMNS FROM $table LIKE '$field'");
        $results = $cols->fetchAll('assoc');
        $enum = explode(',', substr(str_replace(array("'", "(", ")"), '', $results[0]['Type']), 4));
        return $enum;
    }

    public function radioButtonActive($params, $name) {
        if ($params == 'Y') {
            $cekY = 'checked';
            $cekN = '';
        } else {
            $cekY = '';
            $cekN = 'checked';
        }
        echo '<label><input class="flat-red" type="radio" ' . $cekY . ' value="Y" name="' . $name . '"> Active</label><br>';
        echo '<label><input class="flat-red" type="radio" ' . $cekN . ' value="N" name="' . $name . '"> Non Active</label>';
    }

}
