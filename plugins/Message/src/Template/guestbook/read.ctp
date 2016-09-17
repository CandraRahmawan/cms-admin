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
                            <h3 class="box-title">Guestbook</h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <div class="mailbox-read-info">
                                <h3><?php echo $guestbook['subject']; ?></h3>
                                <h5>From: <?php echo $guestbook['full_name'] . " - " . $guestbook['email']; ?>
                                    <span class="mailbox-read-time pull-right"><?php echo date("d-M-Y, H:i", strtotime($guestbook['send_date'])); ?></span></h5>
                            </div>
                        </div>
                        <div class="mailbox-read-message">
                            <?php echo $guestbook['message']; ?>
                        </div>
                        <div class="mailbox-read-message">
                            <?php
                            if ($reply_msg->count() > 0) {
                                echo "<hr>";
                                foreach ($reply_msg->toArray() as $item) {
                                    echo '<i>Send date : ' . date("d-M-Y, H:i", strtotime($item['send_date'])) . '</i><br>';
                                    echo '<i>Reply By : ' . $item['user']['user_name'] . '</i><br><br>';
                                    echo $item['message'];
                                    echo '<hr>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="box-footer">

                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button class="btn btn-default" type="button" onclick="location.href = '<?php echo $this->Url->build(['plugin' => 'Message', 'controller' => 'Guestbook', 'action' => 'reply', '_ext' => 'html']); ?>?guestbook_id=<?php echo $guestbook['guestbook_id']; ?>'"><i class="fa fa-reply"></i> Reply</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php
    echo $this->Element('Dashboard/footer');
    ?>
    <div class = "control-sidebar-bg"></div>
</div>
<?php
$this->Html->script([
    '/assets/lte/plugins/slimScroll/jquery.slimscroll.min',
    '/assets/lte/plugins/fastclick/fastclick',
    '/assets/lte/dist/js/app.min',
    '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);
