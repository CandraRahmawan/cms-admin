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
        const name = data.relatedTarget.dataset.name;
        const email = data.relatedTarget.dataset.email;
        $('#commentDetail').empty();
        $('#commentDetail').append('<table><tr><td>Name</td><td width="20" align="center"> : </td><td>' + name + '</td></tr><tr><td>Email</td><td align="center"> : </td><td>' + email + '</td></tr><tr><td>Review Comment</td><td align="center"> : </td><td>' + comment + '</td></tr></table>');
    });
</script>