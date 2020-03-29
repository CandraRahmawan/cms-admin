<?php
$this->Html->css([
  '/assets/lte/plugins/iCheck/all'], ['block' => 'css']);
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
                                    <div class="form-group" style="margin-top: 15px;">
                                        <label for="title" class="col-sm-2 control-label">Value 1</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name="plugin_detail_id"
                                                   value="<?= $plugin_detail_id ?>">
                                            <input type="text" class="form-control"
                                                   name="value_1"
                                                   value="<?= $value_1; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="title" class="col-sm-2 control-label">Value 2</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="value_2"
                                                      rows="10"><?= $value_2; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image" class="col-sm-2 control-label">Image</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name="image" value="<?= $value_3; ?>"/>
                                            <img src="<?= $value_3; ?>" id=image
                                                 style="height:150px;width:150px;margin-right:8px;object-fit:contain;"/>
                                            <button
                                                    type="button"
                                                    class="btn btn-primary"
                                                    data-key="image"
                                                    data-toggle="modal"
                                                    data-target="#modalListImage"
                                            >
                                                Browse Image
                                            </button>
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
  '/assets/lte/plugins/fastclick/fastclick',
  '/assets/lte/dist/js/app.min',
  '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);

echo $this->Element('Images.modal_list');

use Cake\Datasource\ConnectionManager;

if ($this->request->is('post')) {
  $connection = ConnectionManager::get('default');
  $data = $this->request->data;
  $id = null;
  if (!empty($data['plugin_detail_id'])) {
    $id = $data['plugin_detail_id'];
  }
  
  $value_1 = empty($data['value_1']) ? '-' : $data['value_1'];
  $value_2 = empty($data['value_2']) ? '-' : $data['value_2'];
  $value_3 = empty($data['image']) ? '-' : $data['image'];;
  if (!empty($id)) {
    $connection->update('plugins_detail', ['value_1' => $value_1, 'value_2' => $value_2, 'value_3' => $value_3, 'updated_date' => date('Y-m-d H:i:s')], ['plugin_detail_id' => $id]);
  } else {
    $connection->insert('plugins_detail', ['value_1' => $value_1, 'value_2' => $value_2, 'value_3' => $value_3, 'plugin_id' => $this->request->query('plugin_id')]);
  }
  header("Refresh:0");
}

?>