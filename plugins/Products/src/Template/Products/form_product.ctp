<?php
$this->Html->css([
  '/assets/lte/plugins/select2/select2',
  '/assets/lte/bootstrap/css/fileinput',
  '/assets/lte/plugins/iCheck/all'], ['block' => 'css']);
?>
<script type="text/javascript">
    var preview_path = null;
    var img_name = '';
</script>
<div class="wrapper">
  <?php
  echo $this->Element('Dashboard/header');
  $list_template = '';
  $list_template_note = '';
  $image_upload_note = '';
  foreach ($themes_setting as $item) {
    switch ($item['key']) {
      case 'filename_product_template':
        $list_template = $item['value_1'];
        break;
      case 'filename_product_template_note':
        $list_template_note = $item['value_1'];
        break;
      case 'images_upload_note':
        $image_upload_note = $item['value_1'];
        break;
      default:
        null;
    }
  }
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
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active" id="tab-form"><a href="#form" data-toggle="tab">Product Form</a></li>
                            <li id="tab-image"><a href="#image" data-toggle="tab">Upload Image</a></li>
                            <li id="tab-driver_manual"><a href="#driver_manual" data-toggle="tab">Driver and Manual</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="form">
                              <?php
                              $element = $session->read('Flash')['flash'][0]['element'];
                              if (!empty($element)) {
                                echo $this->Element($element);
                              }
                              echo $this->Form->create($product, ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'form_product', 'name' => 'form_product', 'onsubmit' => 'event.preventDefault();']);
                              ?>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="category_id" class="col-sm-2 control-label">Select Template</label>
                                        <div class="col-sm-10">
                                            <select name="render_template_filename" class="form-control">
                                              <?php
                                              echo '<option disabled selected>Select Template</option>';
                                              $this->Utility->multiSelectThemesSettingOptionView($list_template, $product['render_template_filename']);
                                              ?>
                                            </select>
                                            <b><i><?= $list_template_note; ?></i></b>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id" class="col-sm-2 control-label">Product Category</label>
                                        <div class="col-sm-10">
                                            <select name="category_id" class="form-control">
                                              <?php
                                              echo '<option disabled selected>Select Category</option>';
                                              $this->Utility->categoryOptionView($list_category, $product['category_id']);
                                              ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_name" class="col-sm-2 control-label">Product Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="product_name"
                                                   name="product_name"
                                                   value="<?= $product['name']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subtitle" class="col-sm-2 control-label">Subtitle</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="subtitle" name="subtitle"
                                                   value="<?= $product['subtitle']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description_1" class="col-sm-2 control-label">Description 1</label>
                                        <div class="col-sm-10">
                                    <textarea id="description_1" name="description_1" rows="10"
                                              cols="80"><?= $product['description_1']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description_2" class="col-sm-2 control-label">Description 2</label>
                                        <div class="col-sm-10">
                                    <textarea id="description_2" name="description_2" rows="10"
                                              cols="80"><?= $product['description_2']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="prefix_currency" class="col-sm-2 control-label">Prefix
                                            Currency</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="prefix_currency"
                                                   name="prefix_currency"
                                                   value="<?= $product['prefix_currency']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="price" class="col-sm-2 control-label">Price</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="price" name="price"
                                                   value="<?= $product['price']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="specification" class="col-sm-2 control-label">Specification</label>
                                        <div class="col-sm-10">
                                    <textarea id="specification" name="specification" rows="10"
                                              cols="80"><?= $product['specification']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="features" class="col-sm-2 control-label">Features</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2"
                                                    multiple="multiple"
                                                    name="features[]"
                                                    style="width:100%"
                                            >
                                              <?php
                                              foreach (json_decode($product['features']) as $subitem) {
                                                echo '<option selected="true">' . $subitem . '</option>';
                                              }
                                              ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="features_color" class="col-sm-2 control-label">Features
                                            Color</label>
                                        <div class="col-sm-3">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" id="features_color"
                                                       name="features_color"
                                                       value="<?= $product['features_color']; ?>">
                                                <div class="input-group-btn">
                                                    <div style="width:40px;height:31px;background-color:<?= $product['features_color']; ?>;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="feature_note" class="col-sm-2 control-label">Feature Note</label>
                                        <div class="col-sm-10">
                                    <textarea id="feature_note" name="feature_note" rows="3"
                                              style="width: 100%"><?= $product['feature_note']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="additional_info" class="col-sm-2 control-label">Additional
                                            Info</label>
                                        <div class="col-sm-10">
                                    <textarea id="additional_info" name="additional_info" rows="10"
                                              cols="80"><?= $product['additional_info']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="col-sm-2 control-label">Status</label>
                                        <div class="col-sm-10">
                                          <?php
                                          $this->Utility->radioButtonActive($product['status'], 'status');
                                          ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button class="btn btn-default" type="button"
                                                    onclick="location.href = '<?= $this->Url->build(['plugin' => 'Products', 'controller' => 'Products', 'action' => 'lists', '_ext' => 'html']); ?>'">
                                                <i class="fa fa-angle-left"></i>
                                                Back
                                            </button>
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </div>
                                    </div>
                                </div>
                              <?php echo $this->Form->end(); ?>
                            </div>
                            <div class="tab-pane" id="image">
                                <div class="box-body">
                                    <div id="multiple_images_wrapper" class="form-group">
                                        <div class="col-sm-12">
                                            <input id="multiple_images" name="img_path" type="file" multiple>
                                            <b><i><?= $image_upload_note; ?></i></b>
                                        </div>
                                    </div>
                                    <div id="notes"></div>
                                </div>
                            </div>
                            <div class="tab-pane" id="driver_manual">
                              <?php echo $this->Element('driver_manual'); ?>
                            </div>
                        </div>
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
  '/assets/lte/bootstrap/js/sortable.min',
  '/assets/lte/plugins/select2/select2.min',
  '/assets/lte/bootstrap/js/canvas-to-blob.min',
  '/assets/lte/bootstrap/js/fileinput',
  '/assets/lte/plugins/fastclick/fastclick',
  '/assets/lte/plugins/jquery-validation/dist/jquery.validate.min',
  '/assets/lte/dist/js/app.min',
  '/assets/lte/plugins/iCheck/icheck.min',
  '/assets/lte/plugins/ckeditor/ckeditor',
  '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);
echo $this->Element('loading_modal');
?>

<script type="text/javascript">
    $(document).ready(function () {

        if (window.location.hash == '#tabImage') {
            $('#tab-form').removeClass('active');
            $('#tab-image').addClass('active')
            $('#form').removeClass('active');
            $('#image').addClass('active')
        } else {
            $('#tab-image').removeClass('active');
            $('#tab-form').addClass('active')
            $('#image').removeClass('active');
            $('#form').addClass('active')
        }

        CKEDITOR.replace('description_1');
        CKEDITOR.replace('description_2');
        CKEDITOR.replace('specification');
        CKEDITOR.replace('additional_info');
        CKEDITOR.replace('download_info');
        $('.select2').select2({
            tags: true
        });
        $("#form_product").validate({
            rules: {
                render_template_filename: "required",
                product_name: "required",
                subtitle: "required",
                category_id: "required",
                price: "required",
                prefix_currency: "required"
            },
            messages: {
                render_template_filename: "Template is required",
                product_name: "Product Name is required",
                subtitle: "Subtitle is required",
                category_id: "Product Category is required",
                price: "Price is required",
                prefix_currency: "Currency Price is required"

            },
            submitHandler: function (form) {
                form.submit();
            }
        });

        var product_id = '<?= $this->request->query('product_id'); ?>';
        var gallery_image = [];
        var config_image = [];
        $.ajax({
            url: '<?= $this->Url->build(['plugin' => 'Products', 'controller' => 'Products', 'action' => 'getImage']); ?>',
            data: 'product_id=' + product_id
        }).done(function (data) {
            if (data != 'failed') {
                const jsonData = JSON.parse(data);
                gallery_image = jsonData.items;
                config_image = jsonData.config;
            }
        }).fail(function (jqXHR, msg) {
            console.log(msg);
        }).then(function () {
            if (!product_id) {
                $("#multiple_images_wrapper").hide();
                $("#notes").append('Save your input form first');
            } else {
                $("#multiple_images").fileinput({
                    uploadUrl: '<?= $this->Url->build(['plugin' => 'Products', 'controller' => 'Products', 'action' => 'uploadImage']); ?>?product_id=' + product_id,
                    initialPreview: gallery_image,
                    initialPreviewConfig: config_image,
                    deleteUrl: '<?= $this->Url->build(['plugin' => 'Products', 'controller' => 'Products', 'action' => 'removeImage']); ?>',
                    overwriteInitial: false,
                    allowedFileExtensions: ["jpg", "png", "jpeg"]
                })
            }
        });

        $('#multiple_images').on('fileuploaded', function () {
            let url = window.location.href;
            if (url.indexOf('#tabImage') === -1) {
                url += '#tabImage'
            }
            window.location.href = url;
            window.location.reload();
        });

        $('#multiple_images').on('filesorted', function (event, params) {
            $('#loadingModal').modal({show: true, keyboard: false});
            $.ajax({
                url: "<?= $this->Url->build(['plugin' => 'Products', 'controller' => 'Products', 'action' => 'sortImage']); ?>",
                data: {
                    product_id: product_id,
                    sortItem: params.stack
                }
            }).done(function (data) {
                const msg = JSON.parse(data).msg;
                $('#loadingModal').modal('hide');
                alert(msg);
            }).fail(function (jqXHR, msg) {
                console.log(msg);
                alert('Internal Client Error');
            });
        });
    });

</script>
