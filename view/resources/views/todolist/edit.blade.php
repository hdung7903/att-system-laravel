<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit your task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method='post' action={{route('todolist.update',$todoList->id)}}>
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <lable for="title">Title</lable>
                        <input type="text" name="title" placeholder="Your Task" value="{{ $todoList->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="date">Date:</label>
                        <input type="date" name="date" placeholder="Select Date" class="me-3" value="{!! (String) $todoList->datetime->format('Y-m-d') !!}">
                        <label for="time">Time:</label>
                        <input type="time" name="time" placeholder="Select Time" value="{!!(String) $todoList->datetime->format('H:i') !!}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
