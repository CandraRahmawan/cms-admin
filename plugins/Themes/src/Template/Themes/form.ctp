<?php
$this->Html->css([
  '/assets/lte/plugins/select2/select2',
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
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Setting Theme</h3>
                        </div>
                      <?php
                      $element = $session->read('Flash')['flash'][0]['element'];
                      if (!empty($element)) {
                        echo $this->Element($element);
                      }
                      echo $this->Form->create(null, [
                        'url' => ['action' => 'form'],
                        'class' => 'form-horizontal', 'id' =>
                          'form_theme',
                        'name' => 'form_theme']);
                      echo $this->Form->input('id_theme', ['type' => 'hidden', 'value' => $theme[0]['id_theme']]);
                      
                      foreach ($theme as $item) {
                        ?>
                          <div class="box-body">
                              <div class="form-group">
                                  <label for="<?php echo $item['key']; ?>"
                                         class="col-sm-3 control-label"><?php echo $item['field_name']; ?></label>
                                  <div class="col-sm-9">
                                    <?php
                                    if ('embed' == $item['type']) {
                                      if ('Page' == $item['category']) {
                                        $results = $menuPage;
                                        echo $this->Form->select($item['key'], $results, [
                                          'class' => 'form-control',
                                          'default' => $item['value_1']]);
                                      } else if ('Plugin' == $item['category']) {
                                        $option = $this->Utility->getPluginList($item['key']);
                                        echo $this->Form->select($item['key'], $option, [
                                          'class' => 'form-control',
                                          'default' => $item['value_1']
                                        ]);
                                      } else {
                                        $option = $this->Utility->categoryOption($item['category']);
                                        echo $this->Form->select($item['key'], $option, [
                                          'class' => 'form-control',
                                          'default' => $item['value_1']
                                        ]);
                                      }
                                    } else if ('text' == $item['type']) {
                                      if ('MultiSelect' == $item['category']) {
                                        echo '<select class="form-control select2" multiple name="' . $item['key'] . '[]">';
                                        foreach (json_decode($item['value_1']) as $subitem) {
                                          echo '<option selected>' . $subitem . '</option>';
                                        }
                                        echo '</select>';
                                      } else if ('isActive' == $item['category']) {
                                        $isChecked = $item['value_1'] == 'Y' ? 'checked' : '';
                                        $checkedInfo = $item['value_1'] == 'Y' ? 'Deactivated' : 'Activated';
                                        echo '<input class="flat-red" type="checkbox" name="' . $item['key'] . '" ' . $isChecked . ' /> &nbsp;&nbsp;' . $checkedInfo . '';
                                      } else {
                                        echo '<textarea name="' . $item['key'] . '" class="form-control">' . $item['value_1'] . '</textarea>';
                                      }
                                    } else if ('image' == $item['type']) {
                                      echo '<img id="' . $item['key'] . '" src="' . $item['value_1'] . '" style="height:80px;width:80px;margin-right:8px;object-fit:contain;" />';
                                      echo '<input type="hidden" name="' . $item['key'] . '" value="' . $item['value_1'] . '" />';
                                      echo '<button type="button" class="btn btn-primary" data-key="' . $item['key'] . '" data-toggle="modal" data-target="#modalListImage">Select Image</button>';
                                    }
                                    ?>
                                  </div>
                              </div>
                          </div>
                        <?php
                      }
                      ?>
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
  '/assets/lte/plugins/select2/select2.min',
  '/assets/lte/plugins/fastclick/fastclick',
  '/assets/lte/dist/js/app.min',
  '/assets/lte/plugins/iCheck/icheck.min',
  '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);

echo $this->Element('Images.modal_list');
?>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            tags: true
        });
    });
</script>
