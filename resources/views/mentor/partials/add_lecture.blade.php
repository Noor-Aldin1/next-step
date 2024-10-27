<div class="modal fade none-border" id="add-category2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Schedule a lecture</strong></h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="control-label">Title Lecture</label>
                            <input class="form-control form-white" placeholder="Enter title" type="text"
                                name="category-name">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="control-label">Choose Course</label>
                            <select class="form-control form-white" id="single-select" name="course">
                                <option disabled selected>Choose a name...</option>
                                @foreach ($courseName as $user)
                                    <option value="{{ $user->id }}">{{ $user->title }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="control-label">Start Session</label>
                            <input class="form-control form-white" placeholder="Enter start time" type="text"
                                name="start-session">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="control-label">End Session</label>
                            <input class="form-control form-white" placeholder="Enter end time" type="text"
                                name="end-session">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="control-label">Enter the lecture's link</label>
                            <input class="form-control form-white" placeholder="https://example.com/lecture"
                                type="text" name="lecture-link">
                        </div>

                        <div class="col-12 mb-3">
                            <label class="control-label">Description</label>
                            <textarea class="form-control form-white" placeholder="Enter description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger waves-effect waves-light save-category"
                    data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
