<?php
$this->Html->css(array(
    '/assets/lte/plugins/iCheck/all',
    '/assets/lte/plugins/jquery-validation/demo/site-demos'), ['block' => 'css']);
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
                <div class="col-md-8">
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
                                    <label for="<?php echo $item['key']; ?>" class="col-sm-3 control-label"><?php echo $item['field_name']; ?></label>
                                    <div class="col-sm-9">
                                        <?php
                                        if ('embed' == $item['type']) {
                                            if ('Page' == $item['category']) {
                                                $results = $menuPage;
                                                echo $this->Form->select($item['key'], $results, [
                                                    'class' => 'form-control select2 select2-hidden-accessible',
                                                    'tabindex' => '-1',
                                                    'default' => $item['value_1'],
                                                    'aria-hidden' => 'true']);
                                            } else {
                                                $option = $this->Utility->categoryOption($item['category']);
                                                echo $this->Form->select($item['key'], $option, [
                                                    'class' => 'form-control select2 select2-hidden-accessible',
                                                    'tabindex' => '-1',
                                                    'default' => $item['value_1'],
                                                    'aria-hidden' => 'true']);
                                            }
                                        } else if ('text' == $item['type']) {
                                            echo '<textarea name="' . $item['key'] . '" class="form-control">' . $item['value_1'] . '</textarea>';
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
    '/assets/lte/plugins/fastclick/fastclick',
    '/assets/lte/dist/js/app.min',
    '/assets/lte/plugins/iCheck/icheck.min',
    '/assets/lte/dist/js/main'], ['block' => 'scriptBottom']);