<?php

$this->Html->css(array(
    '/assets/lte/plugins/jQueryUI/jquery-ui',
    '/assets/lte/plugins/iCheck/all',
    '/assets/lte/plugins/jquery-validation/demo/site-demos'), ['block' => 'css']);
?>
<script type="text/javascript">
    var preview_path = null;
    var img_name = '';
</script>
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
                            <h3 class="box-title">Drag and Drop Menu</h3>
                        </div>
                        <?php
                        $element = $session->read('Flash')['flash'][0]['element'];
                        if (!empty($element)) {
                            echo $this->Element($element);
                        }
                        echo $this->Form->create(null, ['class' => 'form-horizontal']);
                        ?>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <h3>Menu Active</h3>
                                        <ul id="items" class="nav nav-stacked bg-gray">
                                            <?php
                                            foreach ($listMenu as $item) {
                                                if ($item->parent_id == 0) {
                                                    echo '<li id="' . $item->id . '"><a href="#"><i class="fa fa-arrows"></i> ' . $item->name . '</a>';
                                                    foreach ($listMenu as $children) {
                                                        if ($children->parent_id == $item->id) {
                                                            echo '<ul><li>' . $children->name . '</li></ul>';
                                                        }
                                                    }
                                                    echo '</li>';
                                                }
                                            }
                                            ?>
                                        </ul>
                                        <input type="hidden" id="sort_value" name="sort_value">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-info">Save</button>
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
    '/components/Sortable/Sortable.min',
    '/assets/lte/plugins/jQueryUI/jquery-ui.min',
    '/assets/lte/plugins/fastclick/fastclick',
    '/assets/lte/dist/js/app.min',
    '/assets/lte/plugins/iCheck/icheck.min',
    '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);
?>

<script type="text/javascript">
    $(function () {
        var sortableElement = document.getElementById('items');
        Sortable.create(sortableElement, {
            onSort: function (event) {
                var children = Array.from(event.path[0].children);
                $("#sort_value").val(children.map(item => item.id));
            },
        });
    });
</script>
