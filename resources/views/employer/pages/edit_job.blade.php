@extends('employer.pages.panel')

@section('maincontent')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex align-items-center mb-4">
                <h3 class="mb-0 me-auto">Update Job</h3>
                <div>
                    <a href="javascript:void(0);" class="btn btn-secondary btn-sm me-3"> <i class="fas fa-envelope"></i></a>
                    <a href="javascript:void(0);" class="btn btn-secondary btn-sm me-3"><i class="fas fa-phone-alt"></i></a>
                    <a href="javascript:void(0);" class="btn btn-primary btn-sm"><i class="fas fa-info"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Start Form -->
                            <form action="{{ route('employer.job_postings.update', $jobPosting->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <label class="form-label font-w600">Job Title<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="title" value="{{ old('title', $jobPosting->title) }}"
                                            class="form-control solid" placeholder="Job Title" required>
                                    </div>
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <label class="form-label font-w600">Company Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="company_name"
                                            value="{{ old('company_name', $jobPosting->company_name) }}"
                                            class="form-control solid" placeholder="Company Name" required>
                                    </div>
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <label class="form-label font-w600">Position<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="position"
                                            value="{{ old('position', $jobPosting->position) }}" class="form-control solid"
                                            placeholder="Position" required>
                                    </div>
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <label class="form-label font-w600">Job Category<span
                                                class="text-danger">*</span></label>
                                        <select name="category" class="form-control solid" required>
                                            <option value="" disabled>Choose...</option>
                                            @foreach ($categories_name as $category)
                                                <option value="{{ $category->name }}"
                                                    {{ $category->name == $jobPosting->category ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <label class="form-label font-w600">Job Type<span
                                                class="text-danger">*</span></label>
                                        <select name="job_type" class="form-control solid" required>
                                            <option value="Full-time"
                                                {{ old('job_type', $jobPosting->job_type) == 'Full-time' ? 'selected' : '' }}>
                                                Full-Time</option>
                                            <option value="Part-time"
                                                {{ old('job_type', $jobPosting->job_type) == 'Part-time' ? 'selected' : '' }}>
                                                Part-Time</option>
                                            <option value="Contract"
                                                {{ old('job_type', $jobPosting->job_type) == 'Contract' ? 'selected' : '' }}>
                                                Contract</option>
                                            <option value="Internship"
                                                {{ old('job_type', $jobPosting->job_type) == 'Internship' ? 'selected' : '' }}>
                                                Internship</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <label class="form-label font-w600">Experience</label>
                                        <input type="text" name="experience"
                                            value="{{ old('experience', $jobPosting->experience) }}"
                                            class="form-control solid" placeholder="Experience">
                                    </div>
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <label class="form-label font-w600">Last Date To Apply</label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            <input size="16" type="date" name="last_date_to_apply"
                                                value="{{ old('last_date_to_apply', $jobPosting->last_date_to_apply) }}"
                                                class="form-control solid">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <label class="form-label font-w600">Salary</label>
                                        <input type="number" name="salary"
                                            value="{{ old('salary', $jobPosting->salary) }}" class="form-control solid"
                                            placeholder="$">
                                    </div>
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <label class="form-label font-w600">City</label>
                                        <input type="text" name="city" value="{{ old('city', $jobPosting->city) }}"
                                            class="form-control solid" placeholder="City" required>
                                    </div>
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <label class="form-label font-w600">Address</label>
                                        <input type="text" name="address"
                                            value="{{ old('address', $jobPosting->address) }}" class="form-control solid"
                                            placeholder="Address" required>
                                    </div>
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <label class="form-label font-w600">Education Level</label>
                                        <input type="text" name="education_level"
                                            value="{{ old('education_level', $jobPosting->education_level) }}"
                                            class="form-control solid" placeholder="Education Level">
                                    </div>
                                    <div class="col-xl-12 mb-4">
                                        <label class="form-label font-w600">Requirements</label>
                                        <textarea name="requirements" class="form-control solid" rows="5">{{ old('requirements', $jobPosting->requirements) }}</textarea>
                                    </div>
                                    <div class="col-xl-12 mb-4">
                                        <label class="form-label font-w600">Description</label>
                                        <textarea name="description" class="form-control solid" rows="5">{{ old('description', $jobPosting->description) }}</textarea>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <div>
                                        <a href="{{ route('employer.job_postings.index') }}"
                                            class="btn btn-danger light me-3">Close</a>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
