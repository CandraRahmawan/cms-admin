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
                              $element = $session->read('Flash')['flash'][0]['element'];
                              if (!empty($element)) {
                                echo $this->Element($element);
                              }
                              ?>
                              <?php
                              $plugin_detail_id[] = '';
                              $value_1[] = '';
                              $value_2[] = '';
                              $value_3[] = '';
                              foreach ($pluginDetail as $index => $item) {
                                $plugin_detail_id[$index] = $item['plugin_detail_id'];
                                $value_1[$index] = $item['value_1'];
                                $value_2[$index] = $item['value_2'];
                                $value_3[$index] = $item['value_3'];
                              }
                              ?>
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#section_1" data-toggle="tab">Section 1</a>
                                                </li>
                                                <li>
                                                    <a href="#section_2" data-toggle="tab">Section 2</a>
                                                </li>
                                                <li>
                                                    <a href="#section_3" data-toggle="tab">Section 3</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="section_1">
                                                    <div class="form-group" style="margin-top: 15px;">
                                                        <label for="value_1" class="col-sm-2 control-label">
                                                            Header Title
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="hidden" name="id[1]"
                                                                   value="<?= isset($plugin_detail_id[0]) ? $plugin_detail_id[0] : ''; ?>">
                                                            <input type="text" class="form-control"
                                                                   name="value_1[1]"
                                                                   value="<?= isset($value_1[0]) ? $value_1[0] : ''; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="value_2" class="col-sm-2 control-label">
                                                            Subtitle
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control"
                                                                   name="value_2[1]"
                                                                   value="<?= isset($value_2[0]) ? $value_2[0] : ''; ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="value_3" class="col-sm-2 control-label">
                                                            Description
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control" name="value_3[1]"
                                                                      rows="5"><?= isset($value_3[0]) ? $value_3[0] : ''; ?>
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="section_2">
                                                    <div class="form-group">
                                                        <label for="value_1" class="col-sm-2 control-label">
                                                            Text
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="hidden" name="id[2]"
                                                                   value="<?= isset($plugin_detail_id[1]) ? $plugin_detail_id[1] : ''; ?>">
                                                            <input type="text" class="form-control"
                                                                   name="value_1[2]"
                                                                   value="<?= isset($value_1[1]) ? $value_1[1] : ''; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="value_2" class="col-sm-2 control-label">
                                                            Image
                                                        </label>
                                                        <div class="col-sm-10">
                                                            <input type="hidden" name="value_2[1]"
                                                                   value="<?= isset($value_2[1]) ? $value_2[1] : ''; ?>"/>
                                                            <img src="<?= isset($value_2[1]) ? $value_2[1] : ''; ?>"
                                                                 id=value_2[1]
                                                                 style="height:150px;width:150px;margin-right:8px;object-fit:contain;"/>
                                                            <button
                                                                    type="button"
                                                                    class="btn btn-primary"
                                                                    data-key="value_2[1]"
                                                                    data-toggle="modal"
                                                                    data-target="#modalListImage"
                                                            >
                                                                Browse Image
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="section_3">
                                                    <h3 class="box-title" style="margin-left: 8px;">
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="addSection()">
                                                            <i class="fa fa-fw fa-plus"></i> Add Section 3
                                                        </button>
                                                    </h3>
                                                    <div class="box-group" id="accordion">
                                                      <?php
                                                      $index = 1;
                                                      for ($i = 2; $i < sizeof($pluginDetail); $i++):
                                                        ?>
                                                          <div class="box-body" id="<?= $index; ?>">
                                                              <div class="panel box box-primary">
                                                                  <div class="box-header with-border">
                                                                      <h4 class="box-title" style="display: block;">
                                                                          <a data-toggle="collapse"
                                                                             data-parent="#accordion"
                                                                             href="#section_3<?= $index; ?>"
                                                                             aria-expanded="true" class="">
                                                                            <?= $value_1[$i]; ?>
                                                                          </a>
                                                                          <a onclick="removeSection('Remove: <?= $value_1[$i]; ?> ?', '<?= $index; ?>')"
                                                                             style="float: right;cursor: pointer;">
                                                                              <i class="fa fa-fw fa-close"></i>
                                                                          </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="section_3<?= $index; ?>"
                                                                       class="panel-collapse collapse"
                                                                       aria-expanded="true">
                                                                      <div class="form-group" style="margin-top: 15px;">
                                                                          <label for="value_1"
                                                                                 class="col-sm-2 control-label">
                                                                              Title
                                                                          </label>
                                                                          <div class="col-sm-10">
                                                                              <input type="hidden"
                                                                                     name="id[<?= $index; ?>]"
                                                                                     value="<?= $plugin_detail_id[$i]; ?>">
                                                                              <input type="text" class="form-control"
                                                                                     name="value_1[<?= $index; ?>]"
                                                                                     value="<?= $value_1[$i]; ?>">
                                                                          </div>
                                                                      </div>
                                                                      <div class="form-group">
                                                                          <label for="value_2"
                                                                                 class="col-sm-2 control-label">
                                                                              Description
                                                                          </label>
                                                                          <div class="col-sm-10">
                                                                              <textarea class="form-control"
                                                                                        name="value_2[<?= $index; ?>]"
                                                                                        rows="5"><?= $value_2[$i];; ?></textarea>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                        <?php $index++; endfor; ?>
                                                    </div>
                                                </div>
                                            </div>
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
?>
    <script>
        let countSection = <?= sizeof($pluginDetail); ?>;

        function addSection() {
            let formGroup = '';
            countSection = countSection + 1;
            let container = document.getElementById('accordion');
            let newSection = document.createElement("div");
            newSection.setAttribute('class', 'box-body');
            newSection.setAttribute('id', countSection);
            formGroup += '<div class="panel box box-primary">';
            formGroup += '<div class="box-header with-border">';
            formGroup += '<h4 class="box-title" style="display: block;">';
            formGroup += '<a data-toggle="collapse" data-parent="#accordion" href="#section_3' + countSection + '" aria-expanded="true">New Section ' + countSection + '</a>';
            formGroup += '<a onclick="removeSection(\'Remove: New Section ' + countSection + ' ?\', ' + countSection + ')" style="float: right;cursor: pointer;"><i class="fa fa-fw fa-close"></i></a>';
            formGroup += '</h4></div>';
            formGroup += '<div id="section_3' + countSection + '" class="panel-collapse collapse in" aria-expanded="true">';
            formGroup += '<div class="form-group" style="margin-top: 15px;">';
            formGroup += '<label for="value_1" class="col-sm-2 control-label">Value 1</label>';
            formGroup += '<div class="col-sm-10">';
            formGroup += '<input type="text" class="form-control" name="value_1[' + countSection + ']">';
            formGroup += '</div></div>';
            formGroup += '<div class="form-group">';
            formGroup += '<label for="value_2" class="col-sm-2 control-label">Value 2</label>';
            formGroup += '<div class="col-sm-10">';
            formGroup += '<textarea class="form-control" name="value_2[' + countSection + ']" rows="5"></textarea>';
            formGroup += '</div></div>';
            formGroup += '</div>';
            newSection.innerHTML = formGroup;
            container.appendChild(newSection);
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
    $value = empty($item) ? '' : $item;
    $result[$key]['value_1'] = $value;
  }
  
  foreach ($data['value_2'] as $key => $item) {
    $value = empty($item) ? '' : $item;
    $result[$key]['value_2'] = $value;
  }
  
  foreach ($data['value_3'] as $key => $item) {
    $value = empty($item) ? '' : $item;
    $result[$key]['value_3'] = $value;
  }
  
  foreach ($result as $item) {
    $value_1 = $item['value_1'];
    $value_2 = $item['value_2'];
    $value_3 = isset($item['value_3']) ? $item['value_3'] : null;
    if (!empty($item['id'])) {
      $connection->update('plugins_detail', ['value_1' => $value_1, 'value_2' => $value_2, 'value_3' => $value_3, 'updated_date' => date('Y-m-d H:i:s')], ['plugin_detail_id' => $item['id']]);
    } else {
      $connection->insert('plugins_detail', ['value_1' => $value_1, 'value_2' => $value_2, 'value_3' => $value_3, 'plugin_id' => $this->request->query('plugin_id')]);
    }
  }
  header("Refresh:0");
}

?>