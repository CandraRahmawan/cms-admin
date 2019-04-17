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
                            <h3 class="box-title">Article</h3>
                        </div>
                        <?php
                        $element = $session->read('Flash')['flash'][0]['element'];
                        if (!empty($element)) {
                            echo $this->Element($element);
                        }
                        echo $this->Form->create($content, ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'form_article', 'name' => 'form_article', 'onsubmit' => 'event.preventDefault();']);
                        ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Title Article</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="content_id" value="<?php echo $content['content_id']; ?>">
                                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $content['title']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">Content</label>
                                <div class="col-sm-10">
                                    <textarea id="description" name="description" rows="10" cols="80">
                                        <?php echo $content['description']; ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="type" value="Content">
                                <label for="category" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-10">
                                    <select name="category_id" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                        <?php
                                        echo '<option disabled selected>Select Category</option>';
                                        $this->Utility->categoryOptionView($list_category, $content['category_id']);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="path_img" class="col-sm-2 control-label">Highlight Image</label>
                                <div class="col-sm-10">
                                    <input id="img_user" name="path_img" type="file" multiple=true>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
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
    'https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js',
    '/assets/lte/dist/js/app.min',
    '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);

if ($content['picture'] != '')
    $path_image = '"' . $this->request->webroot . $this->utility->basePathImgArticle() . $content['category_id'] . '/' . $content['picture'] . '"';
else
    $path_image = 'null';
?>

<script type="text/javascript">
    var preview_path = <?php echo $path_image; ?>;
    var img_name = '<?php echo $content['picture']; ?>';

    $(document).ready(function () {
        CKEDITOR.replace('description');

        $("#form_article").validate({
            rules: {
                title: "required",
                description: "required",
                category_id: "required"
            },
            messages: {
                title: "Title Article is required",
                description: "Description is required",
                category_id: "Category is required"
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>