<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Hash;
use Cake\Core\Configure;

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

    public function basePathImages() {
        $base = Configure::read('urlImage.image_management');
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

    public function categoryOption($params) {
        $conn = ConnectionManager::get('default');
        $cols = $conn->execute("SELECT category_id, name FROM category WHERE status='Y' AND type='{$params}'");
        $results = $cols->fetchAll('assoc');
        $results = Hash::combine($results, '{n}.category_id', '{n}.name');
        return $results;
    }

    public function categoryOptionView($list_category, $category_id) {
        foreach ($list_category as $item) {
            if ($category_id == $item['category_id'])
                echo '<option value="' . $item['category_id'] . '" selected>' . $item['name'] . '</option>';
            else
                echo '<option value="' . $item['category_id'] . '">' . $item['name'] . '</option>';
        }
    }

}
