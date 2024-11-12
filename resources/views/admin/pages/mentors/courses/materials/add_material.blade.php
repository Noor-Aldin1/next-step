@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Add Material Modal -->
<div style="height: auto" id="addMaterialModal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>

            <div class="modal-body">
                <form action="{{ route('mentor.materials.store') }}" method="POST" class="needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <input type="hidden" name="mentor_id" id="mentorId" value="{{ $course->mentor_id }}">
                    <input type="hidden" name="course_id" id="courseId" value="{{ $course->id }}">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label for="taskTitle" class="col-form-label">Title <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" id="taskTitle" required>
                                <div class="invalid-feedback">Please provide a material title.</div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label for="materialFile" class="col-form-label">File <span
                                        class="text-danger">*</span></label>
                                <input type="file" name="file_path" class="form-control" id="materialFile"
                                    accept=".pdf,.doc,.docx,.txt" required>
                                <div class="invalid-feedback">Please upload a file in PDF, DOC, DOCX, or TXT format, max
                                    2MB.</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="input-block mb-3">
                                <label for="taskDescription" class="col-form-label">Description <span
                                        class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" id="taskDescription" rows="3" required></textarea>
                                <div class="invalid-feedback">Please provide a material description.</div>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Save Material</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
