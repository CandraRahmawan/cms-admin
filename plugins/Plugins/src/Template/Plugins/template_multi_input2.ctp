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
                        <div class="box-body" id="btn-add-wrapper">
                            <h3 class="box-title" style="margin-left: 8px;">
                                <button class="btn btn-primary" type="button"
                                        onclick="addSection()">
                                    <i class="fa fa-fw fa-plus"></i> Add <?= $plugin['name']; ?>
                                </button>
                            </h3>
                        </div>
                      <?= $this->Form->create(null, ['class' => 'form-horizontal']); ?>
                        <div class="box-group" id="accordion">
                          <?php foreach ($pluginDetail as $key => $item): $key_id = $key + 1; ?>
                              <div class="box-body" id="<?= $key_id; ?>">
                                  <div class="panel box box-primary">
                                      <div class="box-header with-border">
                                          <h4 class="box-title" style="display: block;">
                                              <a data-toggle="collapse" data-parent="#accordion"
                                                 href="#service<?= $key_id; ?>" aria-expanded="true" class="">
                                                <?= $item['value_1']; ?>
                                              </a>
                                              <a onclick="removeSection('Remove: <?= $item['value_1']; ?> ?', '<?= $key_id; ?>')"
                                                 style="float: right;cursor: pointer;">
                                                  <i class="fa fa-fw fa-close"></i>
                                              </a>
                                          </h4>
                                      </div>
                                      <div id="service<?= $key_id; ?>" class="panel-collapse collapse"
                                           aria-expanded="true">
                                          <div class="form-group" style="margin-top: 15px;">
                                              <label for="value_1" class="col-sm-2 control-label">Value 1</label>
                                              <div class="col-sm-10">
                                                  <input type="hidden" name="id[<?= $key_id; ?>]"
                                                         value="<?= $item['plugin_detail_id']; ?>">
                                                  <input type="text" class="form-control"
                                                         name="value_1[<?= $key_id; ?>]"
                                                         value="<?= $item['value_1']; ?>">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label for="image" class="col-sm-2 control-label">Image</label>
                                              <div class="col-sm-10">
                                                  <input type="hidden" name="image[<?= $key_id; ?>]"
                                                         value="<?= $item['value_2']; ?>">
                                                  <img src="<?= $item['value_2']; ?>"
                                                       id="<?= 'image[' . $key_id . ']'; ?>"
                                                       style="height:150px;width:150px;margin-right:8px;object-fit:contain;"/>
                                                  <button type="button" class="btn btn-primary"
                                                          data-key="<?= 'image[' . $key_id . ']'; ?>"
                                                          data-toggle="modal" data-target="#modalListImage">Browse
                                                      Image
                                                  </button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          <?php endforeach; ?>
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
?>

<script>
    var countSection = <?= sizeof($pluginDetail); ?>;

    function addSection() {
        var formGroup = '';
        countSection = countSection + 1;
        var container = document.getElementById('accordion');
        var serviceSection = document.createElement("div");
        serviceSection.setAttribute('class', 'box-body');
        serviceSection.setAttribute('id', countSection);
        formGroup += '<div class="panel box box-primary">';
        formGroup += '<div class="box-header with-border">';
        formGroup += '<h4 class="box-title" style="display: block;">';
        formGroup += '<a data-toggle="collapse" data-parent="#accordion" href="#service' + countSection + '" aria-expanded="true">New Section ' + countSection + '</a>';
        formGroup += '<a onclick="removeSection(\'Remove: New Section ' + countSection + ' ?\', ' + countSection + ')" style="float: right;cursor: pointer;"><i class="fa fa-fw fa-close"></i></a>';
        formGroup += '</h4></div>';
        formGroup += '<div id="service' + countSection + '" class="panel-collapse collapse in" aria-expanded="true">';
        formGroup += '<div class="form-group" style="margin-top: 15px;">';
        formGroup += '<label for="value_1" class="col-sm-2 control-label">Value 1</label>';
        formGroup += '<div class="col-sm-10">';
        formGroup += '<input type="text" class="form-control" name="value_1[' + countSection + ']">';
        formGroup += '</div></div>';
        formGroup += '<div class="form-group">';
        formGroup += '<label for="image" class="col-sm-2 control-label">Image</label>';
        formGroup += '<div class="col-sm-10">';
        formGroup += '<input type="hidden" name="image[' + countSection + ']">';
        formGroup += '<img id="image[' + countSection + ']" style="height:150px;width:150px;margin-right:8px;object-fit:contain;"/>';
        formGroup += ' <button type="button" class="btn btn-primary" data-key="image[' + countSection + ']" data-toggle="modal" data-target="#modalListImage">Browse Image</button>';
        formGroup += '</div></div></div>';
        serviceSection.innerHTML = formGroup;
        container.appendChild(serviceSection);
    }

    function removeSection(message, key) {
        var confirmMessage = confirm(message);
        var idPluginDetail = $(`input[name$="id[${key}]"]`).val();
        if (confirmMessage) {
            if (idPluginDetail) {
                $.ajax({
                    url: baseUrl + 'plugins/api/delete-plugin-detail/',
                    data: {
                        id: idPluginDetail
                    },
                    beforeSend: function (xhr) {
                        $(`#remove-btn-${key} > i`).remove();
                        $(`#remove-btn-${key}`).append('<i class="fa fa-spin fa-refresh"></i> Deleting...');
                    }
                }).done(function (data) {
                    if (data === 'ok') {
                        alert('success');
                        document.getElementById(key).remove();
                    } else {
                        alert('failed');
                    }
                }).fail(function (jqXHR) {
                    alert('internal server error');
                    console.log('error', jqXHR);
                    $(`#remove-btn-${key} > i`).remove();
                    $(`#remove-btn-${key}`).append('<i class="fa fa-fw fa-close"></i>');
                });
            } else {
                document.getElementById(key).remove();
            }
        } else {
            return false;
        }
    }
</script>

<?php
echo $this->Element('Images.modal_list');

use Cake\Datasource\ConnectionManager;

if ($this->request->is('post')) {
  $connection = ConnectionManager::get('default');
  $data = $this->request->data;
  $result = [];
  if (!empty($data['id'])) {
    foreach ($data['id'] as $key => $item) {
      $result[$key]['id'] = $item;
    }
  }
  
  foreach ($data['value_1'] as $key => $item) {
    $value = empty($item) ? '-' : $item;
    $result[$key]['value_1'] = $value;
  }
  
  foreach ($data['image'] as $key => $item) {
    $value = empty($item) ? '-' : $item;
    $result[$key]['image'] = $value;
  }
  
  foreach ($result as $item) {
    $value_1 = $item['value_1'];
    $image = $item['image'];
    if (!empty($item['id'])) {
      $connection->update('plugins_detail', ['value_1' => $value_1, 'value_2' => $image, 'updated_date' => date('Y-m-d H:i:s')], ['plugin_detail_id' => $item['id']]);
    } else {
      $connection->insert('plugins_detail', ['value_1' => $value_1, 'value_2' => $image, 'plugin_id' => $this->request->query('plugin_id')]);
    }
  }
  header("Refresh:0");
}

?>
