<?php
$element = $session->read('Flash')['flash'][0]['element'];
if (!empty($element)) {
  echo $this->Element($element);
}
echo $this->Form->create($product, ['class' => 'form-horizontal', 'id' => 'form_product_link_download', 'name' => 'form_product_link_download', 'url' => ['action' => 'submitLinkDownload', 'product_id' => $product['product_id']]]);
$link_download = json_decode($product['link_download']);
?>
<div class="box-body">
    <div class="form-group">
        <label for="link_download" class="col-sm-2 control-label">Link Driver URL</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"
                   name="link_download"
                   value="<?= $link_download->download; ?>">
        </div>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <h3 class="box-title" style="margin-left: 8px;">
                <button class="btn btn-primary" type="button"
                        onclick="addSection()">
                    <i class="fa fa-fw fa-plus"></i> Add Manual
                </button>
            </h3>
            <div class="box-group" id="accordion">
              <?php foreach ($link_download->others as $key => $item): $key_id = $key + 1; ?>
                  <div class="box-body" id="<?= $key_id; ?>">
                      <div class="panel box box-primary">
                          <div class="box-header with-border">
                              <h4 class="box-title" style="display: block;">
                                  <a data-toggle="collapse" data-parent="#accordion"
                                     href="#driver_manual<?= $key_id; ?>" aria-expanded="true" class="">
                                    <?= $item->title; ?>
                                  </a>
                                  <a onclick="removeSection('Remove: <?= $item->title; ?> ?', '<?= $key_id; ?>')"
                                     style="float: right;cursor: pointer;">
                                      <i class="fa fa-fw fa-close"></i>
                                  </a>
                              </h4>
                          </div>
                          <div id="driver_manual<?= $key_id; ?>" class="panel-collapse collapse"
                               aria-expanded="true">
                              <div class="form-group" style="margin-top: 15px;">
                                  <label for="title_other" class="col-sm-2 control-label">Title</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control"
                                             name="title_other[<?= $key_id; ?>]"
                                             value="<?= $item->title; ?>">
                                  </div>
                              </div>
                              <div class="form-group" style="margin-top: 15px;">
                                  <label for="link_other" class="col-sm-2 control-label">Link Manual URL</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control"
                                             name="link_other[<?= $key_id; ?>]"
                                             value="<?= $item->link; ?>">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              <?php endforeach; ?>
            </div>
            <div class="box-footer">
                <div class="form-group">
                    <div class="col-sm-10">
                        <button class="btn btn-default" type="button"
                                onclick="location.href = '<?= $this->Url->build(['plugin' => 'Plugins', 'controller' => 'Plugins', 'action' => 'lists', '_ext' => 'html']); ?>'">
                            <i class="fa fa-angle-left"></i>
                            Back
                        </button>
                        <button type="submit" class="btn btn-info right">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $this->Form->end(); ?>

<script>
    var countSection = <?= sizeof($link_download->others); ?>;

    function addSection() {
        var formGroup = '';
        countSection = countSection + 1;
        var container = document.getElementById('accordion');
        var serviceSection = document.createElement("div");
        serviceSection.setAttribute('class', 'box-body');
        serviceSection.setAttribute('id', countSection);
        formGroup += '<div class="panel box box-primary">';
        formGroup += '<div class="box-header with-border">';
        formGroup += '<h4 class="box-title" style="display: block;">';
        formGroup += '<a data-toggle="collapse" data-parent="#accordion" href="#service' + countSection + '" aria-expanded="true">New Manual ' + countSection + '</a>';
        formGroup += '<a onclick="removeSection(\'Remove: New Manual ' + countSection + ' ?\', ' + countSection + ')" style="float: right;cursor: pointer;"><i class="fa fa-fw fa-close"></i></a>';
        formGroup += '</h4></div>';
        formGroup += '<div id="service' + countSection + '" class="panel-collapse collapse in" aria-expanded="true">';
        formGroup += '<div class="form-group" style="margin-top: 15px;">';
        formGroup += '<label for="title_other" class="col-sm-2 control-label">Title</label>';
        formGroup += '<div class="col-sm-10">';
        formGroup += '<input type="text" class="form-control" name="title_other[' + countSection + ']">';
        formGroup += '</div></div>';
        formGroup += '<div class="form-group" style="margin-top: 15px;">';
        formGroup += '<label for="link_other" class="col-sm-2 control-label">Link Manual URL</label>';
        formGroup += '<div class="col-sm-10">';
        formGroup += '<input type="text" class="form-control" name="link_other[' + countSection + ']">';
        formGroup += '</div></div>';
        formGroup += '</div>';
        serviceSection.innerHTML = formGroup;
        container.appendChild(serviceSection);
    }

    function removeSection(message, key) {
        var confirmMessage = confirm(message);
        if (confirmMessage) {
            document.getElementById(key).remove();
        } else {
            return false;
        }
    }
</script>
