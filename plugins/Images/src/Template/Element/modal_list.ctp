<div class="modal fade in" id="modalListImage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Select Image</h4>
            </div>
            <div class="modal-body">
                <div id="listImage" style="display:flex;flex-wrap:wrap;"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitImage()" data-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    var imageKey = '';
    var imagePath = '';
    $("#modalListImage").on('shown.bs.modal', function (data) {
        imageKey = data.relatedTarget.dataset.key;
        $.ajax({
            url: baseUrl + 'images/api/list/',
            beforeSend: function (xhr) {
                $('#listImage').append('<div><i class="fa fa-spin fa-refresh"></i> Loading...</div>');
            }
        }).done(function (data) {
            $('#listImage > div').remove();
            JSON.parse(data).map(function (item) {
                $('#listImage').append('<div class="modal-list-image-items" data-name="' + item.name + '" style="background-image:url(' + item.name + ');width:134px;height:134px;background-size:contain;margin:4px;border:1px solid #2c3e50;cursor: pointer;" onclick="selectedImage(this)"/>');
            });
        }).fail(function (jqXHR) {
            console.log(jqXHR.responseJSON.msg);
        });
    });

    function selectedImage(domElement) {
        $('.modal-list-image-items').css({border: '1px solid #2c3e50', opacity: 'unset'});
        imagePath = domElement.dataset.name;
        domElement.style.border = '2px solid #2980b9';
        domElement.style.opacity = '0.7';
    }

    function submitImage() {
        $('#' + imageKey).attr("src", imagePath);
        $("input[name$='" + imageKey + "']").attr("value", imagePath);
    }
</script>