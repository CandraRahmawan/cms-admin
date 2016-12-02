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
                        ?>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <h3>Menu Active</h3>
                                        <ul id="sortable1" class="connectedSortable">
                                            <?php
                                            $this->Utility->listSortableMenu($listPage, 'ui-state-default', $menuPage, 'menu');
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <h3>Page Menu</h3>
                                        <ul id="sortable2" class="connectedSortable">
                                            <?php
                                            $this->Utility->listSortableMenu($listPage, 'ui-state-highlight', $menuPage, 'list');
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <button type="button" class="btn btn-info" id="saveMenu">Save</button>
                                </div>
                            </div>
                        </div>
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
    '/assets/lte/plugins/jQueryUI/jquery-ui.min',
    '/assets/lte/plugins/fastclick/fastclick',
    '/assets/lte/dist/js/app.min',
    '/assets/lte/plugins/iCheck/icheck.min',
    '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);
?>

<script type="text/javascript">
    $(function () {
        $("#sortable1, #sortable2").sortable({
            connectWith: ".connectedSortable"
        }).disableSelection();

        $("#saveMenu").on('click', function () {
            var data = $("#sortable1").sortable('serialize') + "&menu_id=" + <?php echo $this->request->query['menu_id']; ?>;
            $.ajax({
                data: data,
                type: 'POST',
                url: '<?php echo $this->Url->build(['plugin' => 'Themes', 'controller' => 'Menu', 'action' => 'saveMenu', '_ext' => 'html']); ?>',
                success: function (data) {
                    window.location.href = '<?php echo $this->Url->build(['plugin' => 'Themes', 'controller' => 'Menu', 'action' => 'lists', '_ext' => 'html']); ?>';
                }
            });
        });

    });
</script>