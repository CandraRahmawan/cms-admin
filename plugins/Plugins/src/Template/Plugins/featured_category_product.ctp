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
                    <div class="col-md-9">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?= $plugin['name']; ?></h3>
                              <?php
                              $plugin_detail_id = '';
                              $value_1 = '';
                              $value_2 = '';
                              $value_3 = '';
                              foreach ($pluginDetail as $item) {
                                $plugin_detail_id = $item['plugin_detail_id'];
                                $value_1 = json_decode($item['value_1']);
                                $value_2 = json_decode($item['value_2']);
                                $value_3 = $item['value_3'];
                              }
                              ?>
                            </div>
                            <div class="box-body">
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
                                                     href="#featuredProduct<?= $key_id; ?>">
                                                    <?= $value_1->name . ' - ' . $value_2->title; ?>
                                                  </a>
                                                  <a onclick="removeSection('Remove: <?= $value_1->name; ?> ?', '<?= $key_id; ?>')"
                                                     style="float: right;cursor: pointer;">
                                                      <i class="fa fa-fw fa-close"></i>
                                                  </a>
                                              </h4>
                                          </div>
                                          <div id="featuredProduct<?= $key_id; ?>" class="panel-collapse collapse"
                                               aria-expanded="true">
                                              <div class="form-group" style="margin-top: 15px;">
                                                  <label for="category_name" class="col-sm-2 control-label">
                                                      Category Name
                                                  </label>
                                                  <div class="col-sm-10">
                                                      <input type="hidden" name="id[<?= $key_id; ?>]"
                                                             value="<?= $item['plugin_detail_id']; ?>">
                                                      <select class="form-control select-category"
                                                              name="category_name[<?= $key_id; ?>]"
                                                              data-value="<?= $value_1->id; ?>">
                                                          <option disabled selected>Select Category</option>
                                                      </select>
                                                  </div>
                                              </div>
                                              <div class="form-group" style="margin-top: 15px;">
                                                  <label for="title" class="col-sm-2 control-label">
                                                      Title
                                                  </label>
                                                  <div class="col-sm-10">
                                                      <input type="text" class="form-control"
                                                             name="title[<?= $key_id; ?>]"
                                                             value="<?= $value_2->title; ?>">
                                                  </div>
                                              </div>
                                              <div class="form-group" style="margin-top: 15px;">
                                                  <label for="subtitle" class="col-sm-2 control-label">
                                                      Subtitle
                                                  </label>
                                                  <div class="col-sm-10">
                                                      <input type="text" class="form-control"
                                                             name="subtitle[<?= $key_id; ?>]"
                                                             value="<?= $value_2->subtitle; ?>">
                                                  </div>
                                              </div>
                                              <div class="form-group" style="margin-top: 15px;">
                                                  <label for="description" class="col-sm-2 control-label">
                                                      Description
                                                  </label>
                                                  <div class="col-sm-10">
                                                      <textarea class="form-control" name="description[<?= $key_id; ?>]"
                                                                rows="5"><?= $value_2->description; ?></textarea>
                                                  </div>
                                              </div>
                                              <div class="form-group" style="margin-top: 15px;">
                                                  <label for="bg_color" class="col-sm-2 control-label">
                                                      Background Color Code
                                                  </label>
                                                  <div class="col-sm-10">
                                                      <input type="text" class="form-control"
                                                             name="bg_color[<?= $key_id; ?>]"
                                                             value="<?= $value_2->bg_color; ?>">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label for="type" class="col-sm-2 control-label">Image</label>
                                                  <div class="col-sm-10">
                                                      <input type="hidden" name="image[<?= $key_id; ?>]"
                                                             value="<?= $item['value_3']; ?>">
                                                      <img src="<?= $item['value_3']; ?>"
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
                                        <button type="submit" class="btn btn-info">Submit</button>
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
<?= $this->Html->script([
  '/assets/lte/plugins/fastclick/fastclick',
  '/assets/lte/dist/js/app.min',
  '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);
?>

    <script>
        let countSection = <?= sizeof($pluginDetail); ?>;
        let getStatusCategoryList = false;

        $(document).ready(function () {
            $('.select-category').each(function () {
                const value = $(this).attr('data-value');
                const name = $(this).attr('name');
                getCategoryList(value, name);
            });
        });

        function addSection() {
            var formGroup = '';
            countSection = countSection + 1;
            var container = document.getElementById('accordion');
            var featuredProductSection = document.createElement("div");
            featuredProductSection.setAttribute('class', 'box-body');
            featuredProductSection.setAttribute('id', countSection);
            formGroup += '<div class="panel box box-primary">';
            formGroup += '<div class="box-header with-border">';
            formGroup += '<h4 class="box-title" style="display: block;">';
            formGroup += '<a data-toggle="collapse" data-parent="#accordion" href="#featuredProduct' + countSection + '" aria-expanded="true">Featured Product Section ' + countSection + '</a>';
            formGroup += '<a onclick="removeSection(\'Remove: New Category Section ' + countSection + ' ?\', ' + countSection + ')" style="float: right;cursor: pointer;"><i class="fa fa-fw fa-close"></i></a>';
            formGroup += '</h4></div>';
            formGroup += '<div id="featuredProduct' + countSection + '" class="panel-collapse collapse in" aria-expanded="true">';
            formGroup += '<div class="form-group" style="margin-top: 15px;">';
            formGroup += '<label for="category_name" class="col-sm-2 control-label">Category Name</label>';
            formGroup += '<div class="col-sm-10">';
            formGroup += '<select class="form-control" name="category_name[' + countSection + ']"><option disabled selected>Select Category</option></select>';
            formGroup += '</div></div>';
            formGroup += '<div class="form-group" style="margin-top: 15px;">';
            formGroup += '<label for="title" class="col-sm-2 control-label">Title</label>';
            formGroup += '<div class="col-sm-10">';
            formGroup += '<input type="text" class="form-control" name="title[' + countSection + ']">';
            formGroup += '</div></div>';
            formGroup += '<div class="form-group" style="margin-top: 15px;">';
            formGroup += '<label for="subtitle" class="col-sm-2 control-label">Subtitle</label>';
            formGroup += '<div class="col-sm-10">';
            formGroup += '<input type="text" class="form-control" name="subtitle[' + countSection + ']">';
            formGroup += '</div></div>';
            formGroup += '<div class="form-group">';
            formGroup += '<label for="description" class="col-sm-2 control-label">Description</label>';
            formGroup += '<div class="col-sm-10">';
            formGroup += '<textarea class="form-control" name="description[' + countSection + ']" rows="5"></textarea>';
            formGroup += '</div></div>';
            formGroup += '<div class="form-group" style="margin-top: 15px;">';
            formGroup += '<label for="bg_color" class="col-sm-2 control-label">Background Color Code</label>';
            formGroup += '<div class="col-sm-10">';
            formGroup += '<input type="text" class="form-control" name="bg_color[' + countSection + ']">';
            formGroup += '</div></div>';
            formGroup += '<div class="form-group">';
            formGroup += '<label for="name" class="col-sm-2 control-label">Image</label>';
            formGroup += '<div class="col-sm-10">';
            formGroup += '<input type="hidden" name="image[' + countSection + ']">';
            formGroup += '<img id="image[' + countSection + ']" style="height:150px;width:150px;margin-right:8px;object-fit:contain;"/>';
            formGroup += ' <button type="button" class="btn btn-primary" data-key="image[' + countSection + ']" data-toggle="modal" data-target="#modalListImage">Browse Image</button>';
            formGroup += '</div></div>';
            formGroup += '</div>';
            featuredProductSection.innerHTML = formGroup;
            container.appendChild(featuredProductSection);
            getCategoryList('', 'category_name[' + countSection + ']');
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
                            location.reload();
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

        function getCategoryList(selectedKey, name) {
            $.ajax({
                url: baseUrl + 'plugins/api/get-category-list/',
                data: {
                    type: 'product'
                }
            }).done(function (data) {
                if (data !== 'failed') {
                    JSON.parse(data).map(item => {
                        let selected = selectedKey == item.category_id ? 'selected' : '';
                        $(`select[name="${name}"]`).append(`<option value="${[item.category_id, item.name]}" ${selected}>${item.name}</option>`);
                    });
                    getStatusCategoryList = true;
                }
            }).fail(function (jqXHR) {
                console.log('error', jqXHR);
            });
        }
    </script>

<?= $this->Element('Images.modal_list'); ?>

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
  
  foreach ($data['category_name'] as $key => $item) {
    $explode = explode(',', $item);
    $result[$key]['category_name'] = [
      'id' => $explode[0],
      'name' => $explode[1]
    ];
  }
  
  foreach ($data['title'] as $key => $item) {
    $value = empty($item) ? '-' : $item;
    $result[$key]['title'] = $value;
  }
  
  foreach ($data['subtitle'] as $key => $item) {
    $value = empty($item) ? '-' : $item;
    $result[$key]['subtitle'] = $value;
  }
  
  foreach ($data['description'] as $key => $item) {
    $value = empty($item) ? '-' : $item;
    $result[$key]['description'] = $value;
  }
  
  foreach ($data['bg_color'] as $key => $item) {
    $value = empty($item) ? '#fff' : $item;
    $result[$key]['bg_color'] = $value;
  }
  
  foreach ($data['image'] as $key => $item) {
    $value = empty($item) ? '-' : $item;
    $result[$key]['image'] = $value;
  }
  
  foreach ($result as $item) {
    $val1 = json_encode($item['category_name']);
    $val2 = json_encode([
      'title' => $item['title'],
      'subtitle' => $item['subtitle'],
      'description' => $item['description'],
      'bg_color' => $item['bg_color']
    ]);
    $val3 = $item['image'];
    
    if (!empty($item['id'])) {
      $connection->update('plugins_detail', ['value_1' => $val1, 'value_2' => $val2, 'value_3' => $val3, 'updated_date' => date('Y-m-d H:i:s')], ['plugin_detail_id' => $item['id']]);
    } else {
      $connection->insert('plugins_detail', ['value_1' => $val1, 'value_2' => $val2, 'value_3' => $val3, 'plugin_id' => $this->request->query('plugin_id')]);
    }
  }
  header("Refresh:0");
}

?>