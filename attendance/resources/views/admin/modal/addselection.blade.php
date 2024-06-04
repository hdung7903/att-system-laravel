<div class="modal fade" id="selectionModal" tabindex="-1" aria-labelledby="selectionModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="selectionModal">Which selection you want to add</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <a href="{{ route('admin.adduser') }}" class="btn btn-success">Add by Selection</a>
                <button type="button" class="btn btn-primary"data-bs-toggle="modal" data-bs-target="#selectFileModal">Import File</button>
            </div>
        </div>
    </div>
</div>
@include('admin.modal.selectfile')
