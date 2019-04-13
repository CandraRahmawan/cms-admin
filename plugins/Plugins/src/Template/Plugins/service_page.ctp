<?php
$this->Html->css(array(
    '/assets/lte/plugins/iCheck/all'), ['block' => 'css']);
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
                            <h3 class="box-title">Service Content Page</h3>
                        </div>
                        <div class="box-body">
                            <h3 class="box-title" style="margin-left: 8px;">
                                <button class="btn btn-primary" type="button"
                                        onclick="addSection()">
                                    <i class="fa fa-fw fa-plus"></i> Add Section
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
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Title</label>
                                                <div class="col-sm-9">
                                                    <input type="hidden" name="id[<?= $key_id; ?>]"
                                                           value="<?= $item['plugin_detail_id']; ?>">
                                                    <input type="text" class="form-control"
                                                           name="title[<?= $key_id; ?>]"
                                                           value="<?= $item['value_1']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description"
                                                       class="col-sm-2 control-label">Description</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="description[<?= $key_id; ?>]"
                                                              rows="10"><?= $item['value_2']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="type" class="col-sm-2 control-label">Image</label>
                                                <div class="col-sm-9">
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
    '/assets/lte/plugins/fastclick/fastclick',
    '/assets/lte/plugins/jquery-validation/dist/jquery.validate.min',
    '/assets/lte/dist/js/app.min',
    '/assets/lte/plugins/iCheck/icheck.min',
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
        formGroup += '<a onclick="removeSection(`Remove: New Section ${countSection} ?`, countSection)" style="float: right;cursor: pointer;"><i class="fa fa-fw fa-close"></i></a>';
        formGroup += '</h4></div>';
        formGroup += '<div id="service' + countSection + '" class="panel-collapse collapse in" aria-expanded="true">';
        formGroup += '<div class="form-group">';
        formGroup += '<label for="name" class="col-sm-3 control-label">Title</label>';
        formGroup += '<div class="col-sm-9">';
        formGroup += '<input type="text" class="form-control" name="title[' + countSection + ']">';
        formGroup += '</div></div>';
        formGroup += '<div class="form-group">';
        formGroup += '<label for="name" class="col-sm-3 control-label">Description</label>';
        formGroup += '<div class="col-sm-9">';
        formGroup += '<textarea class="form-control" name="description[' + countSection + ']" rows="10"></textarea>';
        formGroup += '</div></div>';
        formGroup += '<div class="form-group">';
        formGroup += '<label for="name" class="col-sm-3 control-label">Image</label>';
        formGroup += '<div class="col-sm-9">';
        formGroup += '<input type="hidden" name="image[' + countSection + ']">';
        formGroup += '<img id="image[' + countSection + ']" style="height:150px;width:150px;margin-right:8px;object-fit:contain;"/>';
        formGroup += ' <button type="button" class="btn btn-primary" data-key="image[' + countSection + ']" data-toggle="modal" data-target="#modalListImage">Browse Image</button>';
        formGroup += '</div></div></div>';
        serviceSection.innerHTML = formGroup;
        container.appendChild(serviceSection);
    }

    function removeSection(message, key) {
        var confirmMessage = confirm(message);
        confirmMessage ? document.getElementById(key).remove() : false;
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

    foreach ($data['title'] as $key => $item) {
        $value = empty($item) ? '-' : $item;
        $result[$key]['title'] = $value;
    }

    foreach ($data['description'] as $key => $item) {
        $value = empty($item) ? '-' : $item;
        $result[$key]['description'] = $value;
    }

    foreach ($data['image'] as $key => $item) {
        $value = empty($item) ? '-' : $item;
        $result[$key]['image'] = $value;
    }


    foreach ($result as $item) {
        $title = $item['title'];
        $description = $item['description'];
        $image = $item['image'];
        if (!empty($item['id'])) {
            $connection->update('plugins_detail', ['value_1' => $title, 'value_2' => $description, 'value_3' => $image, 'updated_date' => date('Y-m-d H:i:s')], ['plugin_detail_id' => $item['id']]);
        } else {
            $connection->insert('plugins_detail', ['value_1' => $title, 'value_2' => $description, 'value_3' => $image, 'plugin_id' => $this->request->query('plugin_id')]);
        }
    }
    header("Refresh:0");
}

?>
