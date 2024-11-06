@extends('admin.admin_panel')

@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">
                                    <a href="{{ route('admin.users.show', $id) }}">
                                        <i class="fa-solid fa-arrow-left"></i>
                                    </a>Profile Detail
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.users.profileUpdate', $profile->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Full Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="full_name"
                                        value="{{ old('full_name', $profile->full_name) }}" placeholder="John Doe" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                    <input class="form-control" type="email" name="email"
                                        value="{{ old('email', $profile->email) }}" placeholder="johndoe@example.com"
                                        required>
                                </div>
                            </div>
                        </div>

                        <!-- Phone and University Fields -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Phone <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="phone"
                                        value="{{ old('phone', $profile->phone) }}" placeholder="(123) 456-7890" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">University <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="university"
                                        value="{{ old('university', $profile->university) }}"
                                        placeholder="University of Example" required>
                                </div>
                            </div>
                        </div>

                        <!-- Major and Gap Fields -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Major <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="major"
                                        value="{{ old('major', $profile->major) }}" placeholder="Computer Science" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Gap</label>
                                    <input class="form-control" type="text" name="gap"
                                        value="{{ old('gap', $profile->gap) }}" placeholder="3.8 or excellent">
                                </div>
                            </div>
                        </div>

                        <!-- Age and Gender Fields -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Age <span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="age"
                                        value="{{ old('age', $profile->age) }}" placeholder="25" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Gender</label>
                                    <select class="form-control select" name="gender">
                                        <option selected disabled>Choose Gender</option>
                                        <option value="Male"
                                            {{ old('gender', $profile->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female"
                                            {{ old('gender', $profile->gender) == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- About Me, Job Title, and Language Fields -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">About Me</label>
                                    <textarea class="form-control" name="about_me" rows="3" placeholder="Tell us about yourself...">{{ old('about_me', $profile->about_me) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Job Title and Language Fields -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Job Title</label>
                                    <input class="form-control" type="text" name="job_title"
                                        value="{{ old('job_title', $profile->job_title) }}"
                                        placeholder="Software Engineer">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Language</label>
                                    <input class="form-control" type="text" name="language"
                                        value="{{ old('language', $profile->language) }}" placeholder="English, Spanish">
                                </div>
                            </div>
                        </div>

                        <!-- Country, City, LinkedIn, GitHub Fields -->
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">Country</label>
                                    <input class="form-control" type="text" name="country"
                                        value="{{ old('country', $profile->country) }}" placeholder="e.g. Jordan">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">City</label>
                                    <input class="form-control" type="text" name="city"
                                        value="{{ old('city', $profile->city) }}" placeholder="Los Angeles">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">LinkedIn</label>
                                    <input class="form-control" type="text" name="linkedin"
                                        value="{{ old('linkedin', $profile->linkedin) }}"
                                        placeholder="https://linkedin.com/in/yourprofile">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">GitHub</label>
                                    <input class="form-control" type="text" name="github"
                                        value="{{ old('github', $profile->github) }}"
                                        placeholder="https://github.com/yourusername">
                                </div>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->
@endsection
