<?php
$this->Html->css([
    '/assets/lte/plugins/datatables/dataTables.bootstrap'], ['block' => 'css']);
?>
<div class="wrapper">
    <?= $this->Element('Dashboard/header'); ?>
    <aside class="main-sidebar">
        <?= $this->Element('Dashboard/menu-sidebar'); ?>
    </aside>
    <div class="content-wrapper">
        <?= $this->Element('Dashboard/breadcrumb'); ?>
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
                        </div>
                        <div class="box-body">
                            <table id="list_mailbox" class="table table-hover table-striped">
                                <tbody>
                                </tbody>
                            </table>
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
    '/assets/lte/plugins/datatables/jquery.dataTables.min',
    '/assets/lte/plugins/datatables/dataTables.bootstrap.min',
    '/assets/lte/plugins/fastclick/fastclick',
    '/assets/lte/dist/js/app.min',
    '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);
?>
<script type="text/javascript">
    $(function () {
        $('#list_mailbox').DataTable({
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "iDisplayLength": 25,
            "ajax": "<?php echo $this->Url->build(['plugin' => 'Message', 'controller' => 'Mailbox', 'action' => 'serverSide', '_ext' => 'html']); ?>",
            initComplete: function () {
                var api = this.api();
                $('#list_mailbox_filter input')
                    .off('.DT')
                    .on('keyup.DT', function (e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                        }
                    });
            },
            createdRow: function (row, data, index) {
                if (data[4] == 'N')
                    $('td', row).css('font-weight', 'bold');
            },
            "columnDefs": [
                {
                    "targets": [4],
                    "visible": false
                }
            ]
        });
    });
</script>

