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
                            <h3 class="box-title">Youtube Review Section</h3>
                        </div>
                        <div class="box-body">
                            <h3 class="box-title" style="margin-left: 8px;">
                                <button class="btn btn-primary" type="button"
                                        onclick="addSection()">
                                    <i class="fa fa-fw fa-plus"></i> Add Youtube Embed ID
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
                                                   href="#youtube<?= $key_id; ?>" aria-expanded="true" class="">
                                                    <?= $item['value_1']; ?>
                                                </a>
                                                <a onclick="removeSection('Remove: <?= $item['value_1']; ?> ?', '<?= $key_id; ?>')"
                                                   style="float: right;cursor: pointer;">
                                                    <i class="fa fa-fw fa-close"></i>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="youtube<?= $key_id; ?>" class="panel-collapse collapse"
                                             aria-expanded="true">
                                            <div class="form-group" style="margin-top: 15px;">
                                                <label for="name" class="col-sm-2 control-label">Youtube Embed
                                                    ID</label>
                                                <div class="col-sm-9">
                                                    <input type="hidden" name="id[<?= $key_id; ?>]"
                                                           value="<?= $item['plugin_detail_id']; ?>">
                                                    <input type="text" class="form-control"
                                                           name="youtube_id[<?= $key_id; ?>]"
                                                           value="<?= $item['value_1']; ?>">
                                                </div>
                                                <div class="col-sm-9" style="margin-top: 15px;">
                                                    <iframe width="440" height="315"
                                                            src="https://www.youtube.com/embed/<?= $item['value_1']; ?>">
                                                    </iframe>
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
    '/assets/lte/dist/js/app.min',
    '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);
?>

<script>
    var countSection = <?= sizeof($pluginDetail); ?>;

    function addSection() {
        var formGroup = '';
        countSection = countSection + 1;
        var container = document.getElementById('accordion');
        var youtubeSection = document.createElement("div");
        youtubeSection.setAttribute('class', 'box-body');
        youtubeSection.setAttribute('id', countSection);
        formGroup += '<div class="panel box box-primary">';
        formGroup += '<div class="box-header with-border">';
        formGroup += '<h4 class="box-title" style="display: block;">';
        formGroup += '<a data-toggle="collapse" data-parent="#accordion" href="#youtube' + countSection + '" aria-expanded="true">Youtube Review ' + countSection + '</a>';
        formGroup += '<a onclick="removeSection(`Remove: Youtube Review ${countSection} ?`, countSection)" style="float: right;cursor: pointer;"><i class="fa fa-fw fa-close"></i></a>';
        formGroup += '</h4></div>';
        formGroup += '<div id="youtube' + countSection + '" class="panel-collapse collapse in" aria-expanded="true">';
        formGroup += '<div class="form-group" style="margin-top: 15px;">';
        formGroup += '<label for="name" class="col-sm-3 control-label">Youtube Embed ID</label>';
        formGroup += '<div class="col-sm-9">';
        formGroup += '<input type="text" class="form-control" name="youtube_id[' + countSection + ']">';
        formGroup += '</div></div></div>';
        youtubeSection.innerHTML = formGroup;
        container.appendChild(youtubeSection);
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

    foreach ($data['youtube_id'] as $key => $item) {
        $value = empty($item) ? '-' : $item;
        $result[$key]['youtube_id'] = $value;
    }

    foreach ($result as $item) {
        $title = $item['youtube_id'];
        if (!empty($item['id'])) {
            $connection->update('plugins_detail', ['value_1' => $title, 'updated_date' => date('Y-m-d H:i:s')], ['plugin_detail_id' => $item['id']]);
        } else {
            $connection->insert('plugins_detail', ['value_1' => $title, 'plugin_id' => $this->request->query('plugin_id')]);
        }
    }
    header("Refresh:0");
}

?>
