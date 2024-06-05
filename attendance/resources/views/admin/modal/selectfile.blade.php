<div class="modal fade" id="selectFileModal" tabindex="-1" aria-labelledby="selectFileModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="selectionModal">Import User Data File</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="form-control" id="file" name="file"
                        accept=".xlsx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                    <button type="submit" class="btn btn-primary my-3 text-right">Submit File</button>
                </form>
            </div>
        </div>
    </div>
</div>
