<div class="modal fade" id="selectRoleModal" tabindex="-1" aria-labelledby="selectRoleModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="selectionModal">Choose Role for current user</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="approveUserForm" method="POST">
                    @csrf
                    <label class="form-control-label" for="role">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="4">Admin</option>
                        <option value="3">Academic</option>
                        <option value="2">Instructor</option>
                        <option value="1">Student</option>
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" form="approveUserForm">Approve</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectRoleModal = document.getElementById('selectRoleModal');
        selectRoleModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const userId = button.getAttribute('data-user-id');
            const form = selectRoleModal.querySelector('#approveUserForm');
            form.action = `/admin/approve-user/${userId}`;
        });
    });
</script>
