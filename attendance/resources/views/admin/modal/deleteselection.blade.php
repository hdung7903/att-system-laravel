<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Choose which delete you want?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="softDeleteForm" action="" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning">Invalid User</button>
                </form>
                <form id="forceDeleteForm" action="" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete Permanently</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var userId = button.getAttribute('data-user-id');

            var softDeleteForm = document.getElementById('softDeleteForm');
            var forceDeleteForm = document.getElementById('forceDeleteForm');

            softDeleteForm.action = "{{ url('admin/user') }}/" + userId + "/soft-delete";
            forceDeleteForm.action = "{{ url('admin/user') }}/" + userId + "/force-delete";
        });
    });
</script>
