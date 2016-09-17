<?php
$this->Html->css(array(
    '/assets/lte/plugins/iCheck/flat/blue',
    '/assets/lte/plugins/morris/morris',
    '/assets/lte/plugins/jvectormap/jquery-jvectormap-1.2.2'), ['block' => 'css']);
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
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo $count_guestcounter; ?></h3>
                            <p>Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </section>
    </div>
    <?php echo $this->Element('Dashboard/footer'); ?>
    <div class="control-sidebar-bg"></div>
</div>

<?php
$this->Html->script(array(
    '/assets/lte/plugins/jQuery/jquery-2.2.3.min',
    'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
    '/assets/lte/bootstrap/js/bootstrap.min',
    'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js',
    '/assets/lte/plugins/slimScroll/jquery.slimscroll.min',
    '/assets/lte/plugins/fastclick/fastclick',
    '/assets/lte/dist/js/app.min',
    '/assets/lte/dist/js/pages/dashboard',
    '/assets/lte/dist/js/main'), ['block' => 'scriptBottom']);
?>

<script type="text/javascript">
    $.widget.bridge('uibutton', $.ui.button);
</script>
