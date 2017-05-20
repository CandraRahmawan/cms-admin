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
                                        <ul class="listMenuSortable">
                                            <?php
                                            foreach ($listMenu as $item) {
                                                if ($item->parent_id == 0) {
                                                    echo '<li class="external-event bg-light-blue"><div>'.$item->name.'</div>';
                                                    foreach ($listMenu as $children) {
                                                        if ($children->parent_id == $item->id) {
                                                            echo '<ul><li class="external-event bg-light-blue"><div>'.$children->name.'</div></li></ul>'; 
                                                        }
                                                    }
                                                    echo '</li>';
                                                }
                                            }
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
    '/assets/lte/plugins/jquery-sortable-lists/jquery-sortable-lists.min',
    '/assets/lte/plugins/jQueryUI/jquery-ui.min',
    '/assets/lte/plugins/fastclick/fastclick',
    '/assets/lte/dist/js/app.min',
    '/assets/lte/plugins/iCheck/icheck.min',
    '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);
?>

<script type="text/javascript">
    $(function () {
        var options = {
            placeholderCss: {'background-color': 'rgba(0,0,0,0.2)'},
            hintCss: {'background-color': '#bbf'},
            opener: {
                active: true,
                as: 'html', // if as is not set plugin uses background image
                close: '<i class="fa fa-minus c3"></i>', // or 'fa-minus c3',  // or './imgs/Remove2.png',
                open: '<i class="fa fa-plus"></i>', // or 'fa-plus',  // or'./imgs/Add2.png',
                openerCss: {
                    'display': 'inline-block',
                    //'width': '18px', 'height': '18px',
                    'float': 'left',
                    'margin-left': '-35px',
                    'margin-right': '5px',
                    //'background-position': 'center center', 'background-repeat': 'no-repeat',
                    'font-size': '1.1em'
                }
            }
        }
        $('.listMenuSortable').sortableLists(options);

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