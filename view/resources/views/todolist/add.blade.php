<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method='post' action={{route('todolist.store')}}>
                    @csrf
                    <div class="mb-3">
                        <lable for="title">Title</lable>
                        <input type="text" name="title" placeholder="Your Task">
                    </div>
                    <div class="mb-3">
                        <label for="date">Date:</label>
                        <input type="date" name="date" placeholder="Select Date" class="me-3">
                        <label for="time">Time:</label>
                        <input type="time" name="time" placeholder="Select Time">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" id="status" name="status">
                            <option value="0">Not Finished</option>
                            <option value="1">Finished</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </form>
            </div>
        </div>
    </div>
</div>
