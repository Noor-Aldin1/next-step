    <!-- Modal Add meeting -->
    <div class="modal fade none-border" id="add-category">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Schedule a quick meeting</strong></h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="control-label">Choose Student Name</label>
                                <select class="form-control form-white" id="single-select" name="course">
                                    <option disabled selected>Choose a name...</option>
                                    @foreach ($usernames as $user)
                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                                    @endforeach
                                </select>

                            </div>


                            <div class="col-md-6 mb-3">
                                <label class="control-label">Choose Status</label>
                                <select class="form-control form-white" name="course">
                                    <option disabled selected>Status</option>
                                    @foreach ($statuses as $stat)
                                        <option value="{{ $stat }}">{{ $stat }}</option>
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
                                <label class="control-label">Enter the meeting's link</label>
                                <input class="form-control form-white" placeholder="https://example.com/meeting"
                                    type="text" name="lecture-link">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="control-label">Notes</label>
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
