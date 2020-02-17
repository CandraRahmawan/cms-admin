<?php
$this->Html->css(array('/assets/lte/plugins/iCheck/all'), ['block' => 'css']);
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
                        <?php
                        $element = $session->read('Flash')['flash'][0]['element'];
                        if (!empty($element)) {
                            echo $this->Element($element);
                        }
                        $checkedCustomLinkUrl = $menu_detail['custom_link'] ? 'checked' : '';
                        echo $this->Form->create($menu_detail, ['class' => 'form-horizontal', 'id' => 'form_menu_detail', 'name' => 'form_menu_detail', 'onsubmit' => 'event.preventDefault();']);
                        $menu_id = isset($this->request->query['menu_id']) ? $this->request->query['menu_id'] : '0';
                        ?>

                        <div class="box-body">
                            <div class="box-header">
                                <h3 class="box-title">
                                    <button class="btn btn-primary" type="button"
                                            onclick="location.href = '<?= $this->Url->build(['plugin' => 'Themes', 'controller' => 'Menu', 'action' => 'detail', '_ext' => 'html' . '?menu_id=' . $menu_id]); ?>'">
                                        <i class="fa fa-fw fa-list"></i> List Menu Detail
                                    </button>
                                </h3>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Name Menu</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="menu_detail_id"
                                           value="<?= $menu_detail['menu_detail_id']; ?>">
                                    <input type="hidden" name="menu_id"
                                           value="<?= isset($this->request->query['menu_id']) ? $this->request->query['menu_id'] : 0; ?>">
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="<?= $menu_detail['name']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Custom Url ?</label>
                                <div class="col-sm-10">
                                    <input class="flat-red" type="checkbox" id="is_custom_url" />
                                </div>
                            </div>
                            <div class="form-group" id="link_url_content">
                                <input type="hidden" name="type" value="Content">
                                <label for="category" class="col-sm-2 control-label">Dynamic Link Url from Content</label>
                                <div class="col-sm-10">
                                    <select name="content_id" class="form-control select2 select2-hidden-accessible"
                                            tabindex="-1" aria-hidden="true">
                                        <?php
                                        echo '<option selected>Select Content</option>';
                                        $this->Utility->contentOptionView($list_content, $menu_detail['content_id']);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div id="custom_link_url">
                                <div class="form-group">
                                    <label for="custom_link" class="col-sm-2 control-label">Custom Link Url</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="custom_link" name="custom_link"
                                               value="<?= $menu_detail['custom_link']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label">SEO Meta Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                                               value="<?= $seo['meta_title']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="meta_description" class="col-sm-2 control-label">SEO Meta
                                        Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="meta_description"
                                               name="meta_description" value="<?= $seo['meta_description']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <?php
                                    $this->Utility->radioButtonActive($menu_detail['status'], 'status');
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
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
    <?php echo $this->Element('Dashboard/footer'); ?>
    <div class="control-sidebar-bg"></div>
</div>
<?php
$this->Html->script([
    '/assets/lte/plugins/fastclick/fastclick',
    '/assets/lte/plugins/jquery-validation/dist/jquery.validate.min',
    '/assets/lte/plugins/iCheck/icheck.min',
    '/assets/lte/dist/js/app.min',
    '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);
?>

<script type="text/javascript">
    $('#is_custom_url').on('ifChanged', function(event) {
        if (event.target.checked) {
            $("#custom_link_url").show();
            $("#link_url_content").hide();
        } else {
            $("#link_url_content").show();
            $("#custom_link_url").hide();
        }
    });
    var checkedCustomLinkUrl = "<?= $menu_detail['custom_link'] ? 'checked' : ''; ?>";
    $(document).ready(function () {
        $('#is_custom_url').iCheck('check');
        if (checkedCustomLinkUrl === 'checked') {
            $("#custom_link_url").show();
            $("#link_url_content").hide();
        } else {
            $("#custom_link_url").show();
            $("#link_url_content").hide();
        }

        $("#form_menu_detail").validate({
            rules: {
                name: "required"
            },
            messages: {
                name: "Menu Name is required"
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
