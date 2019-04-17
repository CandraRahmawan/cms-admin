<?php
$this->Html->css(array(
    '/assets/lte/bootstrap/css/fileinput',
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
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Upload Images</h3>
                        </div>
                        <?php
                        $element = $session->read('Flash')['flash'][0]['element'];
                        if (!empty($element)) {
                            echo $this->Element($element);
                        }
                        echo $this->Form->create($images, ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'form_images', 'name' => 'form_images', 'onsubmit' => 'event.preventDefault();']);
                        if ($images['name'] != '')
                            $path_image = '"' . $this->request->webroot . $this->utility->basePathImages() . date('Ymd', strtotime($images['created_date'])) . '/' . $images['name'] . '"';
                        else
                            $path_image = 'null';
                        ?>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input id="img_user" name="img_user" type="file" multiple=true>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-12">
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
    '/assets/lte/bootstrap/js/canvas-to-blob.min',
    '/assets/lte/bootstrap/js/fileinput',
    '/assets/lte/plugins/fastclick/fastclick',
    '/assets/lte/plugins/jquery-validation/dist/jquery.validate.min',
    '/assets/lte/plugins/iCheck/icheck.min',
    '/assets/lte/dist/js/app.min',
    '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);
?>

<script type="text/javascript">
    var preview_path = <?php echo $path_image; ?>;
    var img_name = '<?php echo $images['name']; ?>';
    $(document).ready(function () {

    $("#form_images").validate({
    rules: {
<?php if ($path_image == 'null'): ?>
        img_user: "required"
<?php endif; ?>
    },
            messages: {
<?php if ($path_image == 'null'): ?>
                img_user: "Image is required"
<?php endif; ?>
            },
            submitHandler: function (form) {
            form.submit();
            }
    });
    });
</script>