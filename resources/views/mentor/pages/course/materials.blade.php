@extends('mentor.master_page')

@section('content')

    <!-- Content body start -->
    <div class="content-body">
        <div class="container-fluid">
            @include('mentor.pages.course.nav-course')

            <div class="row">
                @include('mentor.pages.course.sideinfo')

                <div class="col-xl-9 col-xxl-8 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <p>{{ $course->description }}</p>
                            <hr>

                            <!-- Material Section -->
                            <div>
                                <div class="d-flex justify-content-between">
                                    <h4 class="text-primary">Course Materials</h4>
                                    <h4><a data-toggle="modal" data-target="#add-material-modal" href="#">Add Material
                                            ➕</a></h4>
                                </div>
                                <div class="overflow-auto" style="max-height: 400px;">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="list-group">
                                        @if ($materials->isEmpty())
                                            <div class="list-group-item">No materials yet.</div>
                                        @else
                                            @foreach ($materials as $material)
                                                <div class="list-group-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h5>{{ $material->title }}</h5>
                                                            <p>{{ $material->description }}</p>
                                                            <p><strong>File:</strong> <a
                                                                    href="{{ asset($material->file_path) }}"
                                                                    target="_blank">Download</a></p>
                                                        </div>
                                                        <div class="btn-group">
                                                            <!-- Edit button with modal trigger -->
                                                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                                data-target="#editMaterialModal-{{ $material->id }}">Edit</button>

                                                            <!-- Delete button with SweetAlert2 confirmation -->
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="deleteMaterial({{ $material->id }})">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Edit Material Modal -->
                                                <div class="modal fade" id="editMaterialModal-{{ $material->id }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="editMaterialModalLabel-{{ $material->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editMaterialModalLabel-{{ $material->id }}">Edit
                                                                    Material</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form
                                                                action="{{ route('mentor.materials.update', $material->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="title-{{ $material->id }}">Title</label>
                                                                        <input type="text" name="title"
                                                                            class="form-control"
                                                                            id="title-{{ $material->id }}"
                                                                            value="{{ $material->title }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="description-{{ $material->id }}">Description</label>
                                                                        <textarea name="description" class="form-control" id="description-{{ $material->id }}">{{ $material->description }}</textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="file_path-{{ $material->id }}">File</label>
                                                                        <input type="file" name="file_path"
                                                                            class="form-control"
                                                                            id="file_path-{{ $material->id }}">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content body end -->

    {{-- --------- Modal Add Material --------- --}}
    <div class="modal fade none-border" id="add-material-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Add Material</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('mentor.materials.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="control-label">Title</label>
                                <input class="form-control" placeholder="Enter title" type="text" name="title">
                                <input type="hidden" class="form-control" value="{{ $course->id }}" name="course_id"
                                    required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="control-label">File</label>
                                <input type="file" class="form-control" name="file_path" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="control-label">Description</label>
                                <textarea class="form-control" placeholder="Enter description" name="description" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- SweetAlert2 script for delete confirmation -->
    <script>
        function deleteMaterial(materialId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the delete action
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ url('mentor/materials') }}' + '/' + materialId;

                    const csrfField = document.createElement('input');
                    csrfField.type = 'hidden';
                    csrfField.name = '_token';
                    csrfField.value = '{{ csrf_token() }}';

                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';

                    form.appendChild(csrfField);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Show success/error alerts
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>

@endsection
