<?php
$this->Html->css(array(
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
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">New Category</h3>
                        </div>
                        <?php
                        $element = $session->read('Flash')['flash'][0]['element'];
                        if (!empty($element)) {
                            echo $this->Element($element);
                        }
                        echo $this->Form->create($category, ['class' => 'form-horizontal', 'id' => 'form_category', 'name' => 'form_category', 'onsubmit' => 'event.preventDefault();']);
                        ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Category Name</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>">
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $category['name']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="description" name="description" value="<?php echo $category['description']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="type" class="col-sm-3 control-label">Type</label>
                                <div class="col-sm-9">
                                    <?php
                                    $status = $this->Utility->enumValue('category', 'type');
                                    foreach ($status as $item) {
                                        if ($item == $category['type'])
                                            echo '<label><input class="flat-red" type="radio"  checked value="' . $item . '" name="type">' . $item . '</label><br>';
                                        else if ($category['type'] == null)
                                            echo '<label><input class="flat-red" type="radio" checked value="' . $item . '" name="type">' . $item . '</label><br>';
                                        else
                                            echo '<label><input class="flat-red" type="radio" value="' . $item . '" name="type">' . $item . '</label><br>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-9">
                                    <?php
                                    $this->Utility->radioButtonActive($category['status'], 'status');
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

<script type="text/javascript">
    $(document).ready(function () {
        $("#form_category").validate({
            rules: {
                name: "required"
            },
            messages: {
                name: "Category Name is required"

            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>