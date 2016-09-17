<?php
$this->Html->css([
    '/assets/lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min'], ['block' => 'css']);
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
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Reply Message Guestbook</h3>
                        </div>
                        <?php
                        $element = $session->read('Flash')['flash'][0]['element'];
                        if (!empty($element)) {
                            echo $this->Element($element);
                        }
                        echo $this->Form->create(null, [
                            'url' => ['action' => 'sumbitReply']]);
                        ?>
                        <div class="box-body">
                            <div class="form-group">
                                <input type="hidden" name="guestbook_id" value="<?php echo $this->request->query['guestbook_id']; ?>">
                                <input placeholder="To:" class="form-control" value="<?php echo $guestbook['email']; ?>" readonly>
                                <input type="hidden" name="to_msg" value="<?php echo $guestbook['email']; ?>">
                            </div>
                            <div class="form-group">
                                <input placeholder="Subject:" class="form-control" name="subject" value="Re - <?php echo $guestbook['subject']; ?>">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" id="compose-textarea">
                                    <i><?php echo $guestbook['message']; ?></i>
                                    <br><br>
                                    <i>----- Reply ----</i>
                                </textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="pull-right">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-envelope-o"></i> Send</button>
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
    <div class = "control-sidebar-bg"></div>
</div>
<?php
$this->Html->script([
    '/assets/lte/plugins/datatables/jquery.dataTables.min',
    '/assets/lte/plugins/datatables/dataTables.bootstrap.min',
    '/assets/lte/plugins/slimScroll/jquery.slimscroll.min',
    '/assets/lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min',
    '/assets/lte/plugins/fastclick/fastclick',
    '/assets/lte/dist/js/app.min',
    '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);
?>
<script type="text/javascript">
    $(function () {
        $("#compose-textarea").wysihtml5();
    });
</script>

