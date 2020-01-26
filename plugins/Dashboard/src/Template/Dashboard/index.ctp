<?php
$this->Html->css([
  '/assets/lte/plugins/morris/morris',
  '/assets/lte/plugins/jvectormap/jquery-jvectormap-1.2.2'], ['block' => 'css']);
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
                </div>
            </section>
        </div>
      <?php echo $this->Element('Dashboard/footer'); ?>
        <div class="control-sidebar-bg"></div>
    </div>

<?php
$this->Html->script([
  '/assets/lte/plugins/jQuery/jquery-2.2.3.min',
  '/assets/lte/plugins/jQueryUI/jquery-ui.min',
  '/assets/lte/bootstrap/js/bootstrap.min',
  'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js',
  '/assets/lte/dist/js/app.min'], ['block' => 'scriptBottom']);
