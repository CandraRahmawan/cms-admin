<?php
$this->Html->css([
  '/assets/lte/plugins/iCheck/all',
  '/assets/lte/plugins/select2/select2'], ['block' => 'css']);
?>
<div class="wrapper">
  <?php
  echo $this->Element('Dashboard/header');
  ?>
    <aside class="main-sidebar">
      <?php echo $this->Element('Dashboard/menu-sidebar'); ?>
    </aside>
    <div class="content-wrapper">
      <?php
      echo $this->Element('Dashboard/breadcrumb');
      ?>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= $plugin['name']; ?></h3>
                        </div>
                      <?= $this->Form->create(null, ['class' => 'form-horizontal']); ?>
                        <div class="box-group">
                          <?php
                          $plugin_detail_id = '';
                          $value_1 = '';
                          $value_2 = '';
                          $value_3 = '';
                          foreach ($pluginDetail as $item) {
                            $plugin_detail_id = $item['plugin_detail_id'];
                            $value_1 = $item['value_1'];
                            $value_2 = $item['value_2'];
                            $value_3 = $item['value_3'];
                          }
                          ?>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="value_2" class="col-sm-2 control-label">Download Info</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" name="plugin_detail_id"
                                               value="<?= $plugin_detail_id ?>">
                                        <textarea class="form-control" name="value_2"
                                                  rows="5"><?= $value_2 ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="value_3" class="col-sm-2 control-label">Drivers Display</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" multiple name="value_3[]">
                                          <?php
                                          foreach ($products as $subitem) {
                                            $selected = $this->Utility->downloadDriverSelected($value_3, $subitem['product_id']);
                                            echo '<option ' . $selected . ' value="' . $subitem['product_id'] . '|' . $subitem['name'] . '">' . $subitem['name'] . '</option>';
                                          }
                                          ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <button class="btn btn-default" type="button"
                                            onclick="location.href = '<?= $this->Url->build(['plugin' => 'Plugins', 'controller' => 'Plugins', 'action' => 'lists', '_ext' => 'html']); ?>'">
                                        <i class="fa fa-angle-left"></i>
                                        Back
                                    </button>
                                    <button type="submit" class="btn btn-info right">Submit</button>
                                </div>
                            </div>
                        </div>
                      <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
  <?php
  echo $this->Element('Dashboard/footer');
  ?>
    <div class="control-sidebar-bg"></div>
</div>
<?php
$this->Html->script([
  '/assets/lte/plugins/select2/select2.min',
  '/assets/lte/plugins/fastclick/fastclick',
  '/assets/lte/dist/js/app.min',
  '/assets/lte/plugins/ckeditor/ckeditor',
  '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);

use Cake\Datasource\ConnectionManager;

if ($this->request->is('post')) {
  $connection = ConnectionManager::get('default');
  $data = $this->request->data;
  $id = null;
  if (!empty($data['plugin_detail_id'])) {
    $id = $data['plugin_detail_id'];
  }
  
  $value_2 = empty($data['value_2']) ? '-' : $data['value_2'];
  $value_3 = empty($data['value_3']) ? [] : $data['value_3'];
  
  $value_3_formatted = [];
  foreach ($value_3 as $key => $item) {
    $explode = explode("|", $item);
    $value_3_formatted[$key]['id'] = $explode[0];
    $value_3_formatted[$key]['name'] = $explode[1];
  }
  
  if (!empty($id)) {
    $connection->update('plugins_detail', ['value_2' => $value_2, 'value_3' => json_encode($value_3_formatted), 'updated_date' => date('Y-m-d H:i:s')], ['plugin_detail_id' => $id]);
  } else {
    $connection->insert('plugins_detail', ['value_2' => $value_2, 'value_3' => json_encode($value_3_formatted), 'plugin_id' => $this->request->query('plugin_id')]);
  }
  header("Refresh:0");
}

?>

<script type="text/javascript">
    $(document).ready(function () {
        CKEDITOR.replace('value_2');
        $('.select2').select2({
            tags: true
        });
    });
</script>
