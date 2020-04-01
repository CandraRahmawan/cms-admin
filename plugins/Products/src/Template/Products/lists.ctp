<?php
$this->Html->css([
  '/assets/lte/plugins/datatables/dataTables.bootstrap'], ['block' => 'css']);
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
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                          <?php
                          $element = $session->read('Flash')['flash'][0]['element'];
                          if (!empty($element)) {
                            echo $this->Element($element);
                          }
                          ?>
                            <h3 class="box-title">
                                <button class="btn btn-block btn-primary" type="button"
                                        onclick="location.href = '<?php echo $this->Url->build(['plugin' => 'Products', 'controller' => 'Products', 'action' => 'formProduct', '_ext' => 'html']); ?>'">
                                    <i class="fa fa-fw fa-cart-plus"></i> Add Item
                                </button>
                            </h3>
                        </div>
                        <div class="box-body">
                            <table id="list_products" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                  <?php
                                  for ($i = 0; $i < count($option_field); $i++) {
                                    echo '<th>' . array_keys($option_field)[$i] . '</th>';
                                  }
                                  ?>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr>
                                  <?php
                                  for ($i = 0; $i < count($option_field); $i++) {
                                    echo '<th>' . array_keys($option_field)[$i] . '</th>';
                                  }
                                  ?>
                                </tr>
                                </tfoot>
                            </table>
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
  '/assets/lte/plugins/datatables/jquery.dataTables.min',
  '/assets/lte/plugins/datatables/dataTables.bootstrap.min',
  '/assets/lte/dist/js/app.min',
  '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);
?>
<script type="text/javascript">
    $(function () {
        $('#list_products').DataTable({
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "iDisplayLength": 25,
            "ajax": "<?php echo $this->Url->build(['plugin' => 'Products', 'controller' => 'Products', 'action' => 'serverSide', '_ext' => 'html']); ?>",
            initComplete: function () {
                var api = this.api();
                $('#list_products_filter input')
                    .off('.DT')
                    .on('keyup.DT', function (e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                        }
                    });
            }
        });
    });
</script>