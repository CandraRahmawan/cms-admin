<?php
$this->Html->css(array('/assets/lte/plugins/select2/select2'), ['block' => 'css']);
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
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Location List Section</h3>
                        </div>
                        <div class="box-body">
                            <h3 class="box-title" style="margin-left: 8px;">
                                <button class="btn btn-primary" type="button"
                                        onclick="addSection()">
                                    <i class="fa fa-fw fa-plus"></i> Add Location
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
                                                   href="#location<?= $key_id; ?>" aria-expanded="true" class="">
                                                    <?= $item['value_1']; ?>
                                                </a>
                                                <a id="remove-btn-<?= $key_id; ?>"
                                                   onclick="removeSection('Remove: <?= $item['value_1']; ?> ?', '<?= $key_id; ?>')"
                                                   style="float: right;cursor: pointer;">
                                                    <i class="fa fa-fw fa-close"></i>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="location<?= $key_id; ?>" class="panel-collapse collapse"
                                             aria-expanded="true">
                                            <div class="form-group" style="margin-top: 15px;">
                                                <label for="name" class="col-sm-3 control-label">Location</label>
                                                <div class="col-sm-8">
                                                    <input type="hidden" name="id[<?= $key_id; ?>]"
                                                           value="<?= $item['plugin_detail_id']; ?>">
                                                    <input type="text" class="form-control"
                                                           name="location[<?= $key_id; ?>]"
                                                           value="<?= $item['value_1']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="col-sm-3 control-label">
                                                    Sub Location
                                                </label>
                                                <div class="col-sm-8">
                                                    <select class="form-control select2"
                                                            multiple="multiple"
                                                            name="sublocation[<?= $key_id; ?>][]"
                                                            style="width:100%"
                                                    >
                                                        <?php
                                                        foreach (json_decode($item['value_2']) as $subitem) {
                                                            echo '<option selected="true">' . $subitem . '</option>';
                                                        }
                                                        ?>
                                                    </select>
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
<?php
$this->Html->script([
    '/assets/lte/plugins/select2/select2.min',
    '/assets/lte/plugins/fastclick/fastclick',
    '/assets/lte/dist/js/app.min',
    '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);
?>

<script>
    $(function () {
        $('.select2').select2({
            tags: true
        });
    });

    var countSection = <?= sizeof($pluginDetail); ?>;

    function addSection() {
        var formGroup = '';
        countSection = countSection + 1;
        var container = document.getElementById('accordion');
        var locationSection = document.createElement("div");
        locationSection.setAttribute('class', 'box-body');
        locationSection.setAttribute('id', countSection);
        formGroup += '<div class="panel box box-primary">';
        formGroup += '<div class="box-header with-border">';
        formGroup += '<h4 class="box-title" style="display: block;">';
        formGroup += '<a data-toggle="collapse" data-parent="#accordion" href="#location' + countSection + '" aria-expanded="true">New Section ' + countSection + '</a>';
        formGroup += '<a id="remove-btn-' + countSection + '" onclick="removeSection(`Remove: New Section ${countSection} ?`, countSection)" style="float: right;cursor: pointer;"><i class="fa fa-fw fa-close"></i></a>';
        formGroup += '</h4></div>';
        formGroup += '<div id="location' + countSection + '" class="panel-collapse collapse in" aria-expanded="true">';
        formGroup += '<div class="form-group" style="margin-top: 15px;">';
        formGroup += '<label for="name" class="col-sm-3 control-label">Location</label>';
        formGroup += '<div class="col-sm-8">';
        formGroup += '<input type="text" class="form-control" name="location[' + countSection + ']">';
        formGroup += '</div></div>';
        formGroup += '<div class="form-group">';
        formGroup += '<label for="name" class="col-sm-3 control-label">Sub Location</label>';
        formGroup += '<div class="col-sm-8">';
        formGroup += '<select class="form-control select2" multiple="multiple" name="sublocation[' + countSection + '][]" style="width:100%"><option></option></select>';
        formGroup += '</div></div></div></div>';
        locationSection.innerHTML = formGroup;
        container.appendChild(locationSection);
        $('.select2').select2({
            tags: true
        });
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

    foreach ($data['location'] as $key => $item) {
        $value = empty($item) ? '-' : $item;
        $result[$key]['location'] = $value;
    }

    foreach ($data['sublocation'] as $key => $item) {
        if (!empty($item)) {
            $subitems = [];
            foreach ($item as $subkey => $subitem) {
                $subitems[$subkey] = $subitem;
            }
        }
        $result[$key]['sublocation'] = json_encode($subitems);
    }

    foreach ($result as $item) {
        $location = $item['location'];
        $sublocation = $item['sublocation'];
        if (!empty($item['id'])) {
            $connection->update('plugins_detail', ['value_1' => $location, 'value_2' => $sublocation, 'updated_date' => date('Y-m-d H:i:s')], ['plugin_detail_id' => $item['id']]);
        } else {
            $connection->insert('plugins_detail', ['value_1' => $location, 'value_2' => $sublocation, 'plugin_id' => $this->request->query('plugin_id')]);
        }
    }
    header("Refresh:0");
}

?>
