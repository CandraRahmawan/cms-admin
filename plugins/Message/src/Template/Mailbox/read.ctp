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
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">From
                                : <?php echo $mailbox['name'] . " - " . $mailbox['email']; ?></h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <div class="mailbox-read-info">
                                <h5>Send Date :
                                    <b><?php echo date("d-M-Y, H:i", strtotime($mailbox['send_date'])); ?></b></h5>
                            </div>
                        </div>
                        <div class="mailbox-read-message">
                            <?php echo $mailbox['message']; ?>
                        </div>
                        <div class="box-footer">
                            <div class="pull-left">
                                <button class="btn btn-default" type="button"
                                        onclick="location.href = '<?php echo $this->Url->build(['plugin' => 'Message', 'controller' => 'Mailbox', 'action' => 'lists', '_ext' => 'html']); ?>'">
                                    <i class="fa fa-angle-left"></i>
                                    Back
                                </button>
                            </div>
                        </div>
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
    '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);
