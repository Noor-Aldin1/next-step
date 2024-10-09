@extends('employer.pages.panel')
@section('maincontent')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="d-flex align-items-center mb-4 flex-wrap">
                <h3 class="me-auto">Job View</h3>

            </div>
            <div class="row">
                <div class="col-xl-3 col-xxl-4">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header border-0 pb-0">
                                    <h4 class="fs-20 mb-0">Overview</h4>
                                </div>
                                <div class="card-body pt-4">
                                    <div class="mb-3 d-flex">
                                        <h5 class="mb-1 fs-14 custom-label">Position:</h5>
                                        <span>{{ $jobPosting->position }}</span>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <h5 class="mb-1 fs-14 custom-label">Category:</h5>
                                        @foreach ($categories_name as $name)
                                            <span>{{ $name->name }}</span>
                                        @endforeach
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <h5 class="mb-1 fs-14 custom-label">Experience:</h5>
                                        <span>{{ $jobPosting->experience }}</span>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <h5 class="mb-1 fs-14 custom-label">Education Level</h5>
                                        <span>{{ $jobPosting->education_level }}</span>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <h5 class="mb-1 fs-14 custom-label">Job Type:</h5>
                                        <span>{{ $jobPosting->job_type }}</span>

                                    </div>
                                    <div class="mb-3 d-flex">
                                        <h5 class="mb-1 fs-14 custom-label">Posted Date:</h5>
                                        <span>{{ $jobPosting->post_due }}</span>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <h5 class="mb-1 fs-14 custom-label">Last Apply Date:</h5>
                                        <span>{{ $jobPosting->last_date_to_apply }}</span>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <h5 class="mb-1 fs-14 custom-label">Location</h5>
                                        <span>{{ $jobPosting->address }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-xxl-8">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header d-block">
                                    <h4 class="fs-20 d-block"><a href="javascript:void(0);"
                                            class="text-black">{{ $jobPosting->title }}</a></h4>
                                    <div class="d-block">
                                        <span class="me-2"><a href="javascript:void(0);"><i
                                                    class="text-primary fas fa-briefcase me-2"></i>{{ $jobPosting->company_name }}</a></span>
                                        <span class="me-2"><a href="javascript:void(0);"><i
                                                    class="text-primary fas fa-map-marker-alt me-2"></i>{{ $jobPosting->city }}</a></span>

                                    </div>
                                </div>
                                <div class="card-body pb-0">
                                    <h4 class="fs-20 mb-3">Description</h4>
                                    <div>
                                        <p>{{ $jobPosting->description }}
                                        </p>
                                        <hr>
                                        <h4 class="fs-20 mb-3">Job Requirements</h4>
                                        <div class="row mb-3">
                                            <div class="col-xl-12">
                                                <div>
                                                    <p>
                                                        {{ $jobPosting->requirements }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="d-flex justify-content-between py-4 border-bottom border-top flex-wrap">
                                            <span>Job ID: {{ $jobPosting->id }}</span>
                                        </div>
                                    </div>
                                    <div class="card-footer border-0">
                                        <div>
                                            <!-- Edit Job Button -->
                                            <a href="{{ route('employer.job_postings.edit', $jobPosting->id) }}"
                                                class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </a>


                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm me-2"
                                                data-id="{{ $jobPosting->id }}" onclick="confirmDelete(this)">
                                                <i class="fas fa-trash-alt me-2"></i>Delete
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script>
            function confirmDelete(element) {
                const jobId = element.getAttribute('data-id');


                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, send a DELETE request to the server
                        deleteJobPosting(jobId);
                    }
                });
            }

            function deleteJobPosting(jobId) {
                $.ajax({
                    url: `/employer/job_postings/${jobId} `,
                    type: 'DELETE',
                    data: {
                        '_token': '{{ csrf_token() }}' // Include CSRF token for Laravel
                    },
                    success: function(result) {
                        // Handle success, e.g., show a success message and reload the page
                        Swal.fire(
                            'Deleted!',
                            'Your job posting has been deleted.',
                            'success'
                        ).then(() => {
                            window.location.href =
                                "{{ route('employer.job_postings.dashbord') }}"; // Redirect to the dashboard route after deletion
                        });
                    },
                    error: function(xhr) {
                        // Handle error
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting the job posting. Please try again.',
                            'error'
                        );
                    }
                });
            }
        </script>
    @endsection
