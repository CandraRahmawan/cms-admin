<?php
$this->Html->css(array(
    '/assets/lte/bootstrap/css/fileinput',
    '/assets/lte/plugins/iCheck/all',
    '/assets/lte/plugins/jquery-validation/demo/site-demos'), ['block' => 'css']);
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
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">New Slider Banner</h3>
                        </div>
                        <?php
                        $element = $session->read('Flash')['flash'][0]['element'];
                        if (!empty($element)) {
                            echo $this->Element($element);
                        }
                        echo $this->Form->create($sliderBanner, ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'form_sliderBanner', 'name' => 'form_sliderBanner', 'onsubmit' => 'event.preventDefault();']);
                        if ($sliderBanner['path'] != '')
                            $path_image = '"' . $this->request->webroot . $this->utility->basePathImgSliderBanner() . $sliderBanner['category_id'] . '/' . $sliderBanner['path'] . '"';
                        else
                            $path_image = 'null';
                        ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $sliderBanner['title']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="description" name="description" value="<?php echo $sliderBanner['description']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">Link</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="link" name="link" value="<?php echo $sliderBanner['link']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-9">
                                    <select name="category_id" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">                                        
                                        <?php
                                        echo '<option disabled selected>Select Category</option>';
                                        foreach ($list_category as $item) {
                                            if ($sliderBanner['category_id'] == $item['category_id'])
                                                echo '<option value="' . $item['category_id'] . '" selected>' . $item['name'] . '</option>';
                                            else
                                                echo '<option value="' . $item['category_id'] . '">' . $item['name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="img_user" class="col-sm-2 control-label">Image</label>
                                <div class="col-sm-9">
                                    <input id="img_user" name="img_user" type="file" multiple=true>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="is_active" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-9">
                                    <?php
                                    $this->Utility->radioButtonActive($sliderBanner['is_active'], 'is_active');
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
    var img_name = '<?php echo $sliderBanner['path']; ?>';
    $(document).ready(function () {

    $("#form_sliderBanner").validate({
    rules: {
    title: "required",
            category_id: "required",
<?php if ($path_image == 'null'): ?>
        img_user: "required"
<?php endif; ?>
    },
            messages: {
            title: "Title Slider Banner is required",
                    category_id: "Category is required",
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