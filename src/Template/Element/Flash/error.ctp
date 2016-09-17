<?php
$message = $session->read('Flash')['flash'][0]['message'];
?>
<div class="alert alert-danger alert-dismissible">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <h4><i class="iccon fa fa-ban"></i> Error!</h4>
    <?php echo $message; ?>
</div>
<?php
$session->delete('Flash');
