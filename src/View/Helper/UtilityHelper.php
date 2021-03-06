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
    $base = 'img' . DS . 'Gallery' . DS . 'SliderBanner' . DS;
    return $base;
  }
  
  public function basePathImages($key = 'image_management') {
    return Configure::read('urlImage.' . $key . '');
  }
  
  public function enumValue($table, $field) {
    $conn = ConnectionManager::get('default');
    $cols = $conn->execute("SHOW COLUMNS FROM $table LIKE '$field'");
    $results = $cols->fetchAll('assoc');
    $enum = explode(',', substr(str_replace(["'", "(", ")"], '', $results[0]['Type']), 4));
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
    $cols = $conn->execute("SELECT category_id, name FROM category WHERE status = 'Y' AND type = '{$params}'");
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
  
  public function contentOptionView($list_content, $content_id) {
    foreach ($list_content as $item) {
      if ($content_id == $item['content_id'])
        echo '<option value="' . $item['content_id'] . '" selected>' . $item['category']['name'] . '</option>';
      else
        echo '<option value="' . $item['content_id'] . '">' . $item['category']['name'] . '</option>';
    }
  }
  
  public function getPluginList($key) {
    $conn = ConnectionManager::get('default');
    $cols = $conn->execute("SELECT plugin_id, name FROM plugins WHERE is_active = 'Y' AND `key` = '{$key}'");
    $results = $cols->fetchAll('assoc');
    $results = Hash::combine($results, '{n}.plugin_id', '{n}.name');
    return $results;
  }
  
  public function multiSelectThemesSettingOptionView($list, $selected) {
    $option_list = json_decode($list);
    foreach ($option_list as $subItem) {
      if ($selected == $subItem)
        echo '<option value="' . $subItem . '" selected>' . $subItem . '</option>';
      else
        echo '<option value="' . $subItem . '">' . $subItem . '</option>';
    }
  }
  
  public function downloadDriverSelected($list, $id) {
    $selected = '';
    foreach (json_decode($list) as $val) {
      if ($val->id == $id) {
        $selected = 'selected';
        break;
      }
    }
    return $selected;
  }
  
}
