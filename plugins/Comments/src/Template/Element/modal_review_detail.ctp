<div class="modal fade in" id="modalReviewComment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Comments</h4>
            </div>
            <div class="modal-body">
                <div id="commentDetail"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#modalReviewComment").on('shown.bs.modal', function (data) {
        const comment = data.relatedTarget.dataset.comment;
        $('#commentDetail').append('<div>' + comment + '</div>');
    });
</script>