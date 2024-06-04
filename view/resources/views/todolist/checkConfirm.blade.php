<div class="modal fade" id="checkConfirmation" tabindex="-1" aria-labelledby="checkConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Check your submittion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('todolist.destroy', $todoList->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    Are you sure?                    
                    <div class="align-self-end mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
