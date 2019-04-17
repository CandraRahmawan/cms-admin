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
                <div class="col-md-10">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Section</h3>
                        </div>
                        <?php
                        $element = $session->read('Flash')['flash'][0]['element'];
                        if (!empty($element)) {
                            echo $this->Element($element);
                        }
                        echo $this->Form->create($content, ['class' => 'form-horizontal', 'id' => 'form_section', 'name' => 'form_section', 'onsubmit' => 'event.preventDefault();']);
                        ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">Description Section</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="description" id="description" rows="8"><?php echo $content['description']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category" class="col-sm-2 control-label">Location Section</label>
                                <div class="col-sm-9">
                                    <select name="category_id" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                        <?php
                                        echo '<option disabled selected>Select Location Section</option>';
                                        $this->Utility->categoryOptionView($list_category, $content['category_id']);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="type" value="Page">
                                <label for="status" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-9">
                                    <?php
                                    $this->Utility->radioButtonActive($content['status'], 'status');
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
    '/assets/lte/dist/js/app.min',
    '/assets/lte/plugins/jquery-validation/dist/jquery.validate.min',
    '/assets/lte/plugins/iCheck/icheck.min',
    '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);
?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#form_section").validate({
            rules: {
                description: "required",
                category_id: "required"
            },
            messages: {
                description: "Description is required",
                category_id: "Section location is required"
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
