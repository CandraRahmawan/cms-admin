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
                            <h3 class="box-title">New Users</h3>
                        </div>
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
                                    <select name="category_id" class="form-control">
                                      <?php
                                      echo '<option disabled selected>Select Template</option>';
                                      $this->Utility->multiSelectThemesSettingOptionView($list_themes_setting, $product['render_template_filename']);
                                      ?>
                                    </select>
                                    <b><i>Temporary note : template_1(GM500), template_2(dbe hardcase), template_3(Dbe Comfit Eartips)</i></b>
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
                                    <input type="text" class="form-control" id="product_name" name="product_name"
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
                                <label for="prefix_currency" class="col-sm-2 control-label">Prefix Currency</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="prefix_currency" name="prefix_currency"
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
                                <label for="feature_note" class="col-sm-2 control-label">Feature Note</label>
                                <div class="col-sm-10">
                                    <textarea id="feature_note" name="feature_note" rows="3"
                                              cols="127"><?= $product['feature_note']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="additional_info" class="col-sm-2 control-label">Additional Info</label>
                                <div class="col-sm-10">
                                    <textarea id="additional_info" name="additional_info" rows="10"
                                              cols="80"><?= $product['additional_info']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="path_img" class="col-sm-2 control-label">Upload Images</label>
                                <div class="col-sm-10">
                                    <input id="img_user" name="path_img" type="file" multiple=true>
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
                </div>
            </div>
        </section>
    </div>
  <?php echo $this->Element('Dashboard/footer'); ?>
    <div class="control-sidebar-bg"></div>
</div>
<?php
$this->Html->script([
  '/assets/lte/plugins/select2/select2.min',
  '/assets/lte/bootstrap/js/canvas-to-blob.min',
  '/assets/lte/bootstrap/js/fileinput',
  '/assets/lte/plugins/fastclick/fastclick',
  '/assets/lte/plugins/jquery-validation/dist/jquery.validate.min',
  '/assets/lte/dist/js/app.min',
  '/assets/lte/plugins/iCheck/icheck.min',
  'https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js',
  '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);
?>

<script type="text/javascript">
    $(document).ready(function () {
        CKEDITOR.replace('description_1');
        CKEDITOR.replace('description_2');
        CKEDITOR.replace('specification');
        CKEDITOR.replace('additional_info');
        $('.select2').select2({
            tags: true
        });
        $("#form_product").validate({
            rules: {
                product_name: "required",
                subtitle: "required",
                category_id: "required",
                price: "required",
                prefix_currency: "required"
            },
            messages: {
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
    });

</script>
