@extends('user.index')
@section('content')
    <!-- Page Title Start -->
    <section class="page-title title-bg10">
        <div class="d-table">
            <div class="d-table-cell">
                <h2>Profile</h2>
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>Profile</li>
                </ul>
            </div>
        </div>
        <div class="lines">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </section>
    <!-- Page Title End -->


    <!-- Account Area Start -->
    <section class="account-section ptb-100">
        <div class="container">
            <div class="row">
                {{-- Informational aspect --}}
                @include('user.pages.profile.side_info')

                <div class="col-md-8">
                    <div class="account-details">
                        <h3>Profile Information</h3>
                        <form action="{{ route('profile.update') }}" method="POST" class="profile-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name <span class="required-star">*</span></label>
                                        <input type="text" name="full_name" class="form-control" placeholder="Your Name"
                                            value="{{ old('full_name', $profile->full_name) }}" required disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Your Email <span class="required-star">*</span></label>
                                        <input type="email" name="email" class="form-control" placeholder="Your Email"
                                            value="{{ old('email', $profile->email) }}" required disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Your Phone <span class="required-star">*</span></label>
                                        <input type="text" name="phone" class="form-control" maxlength="15"
                                            placeholder="Your Phone" value="{{ old('phone', $profile->phone) }}" required
                                            disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>University <span class="required-star">*</span></label>
                                        <input type="text" name="university" class="form-control"
                                            placeholder="e.g University Of Jordan"
                                            value="{{ old('university', $profile->university) }}" required disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Major <span class="required-star">*</span></label>
                                        <input type="text" name="major" class="form-control" placeholder="e.g MIS"
                                            value="{{ old('major', $profile->major) }}" required disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>GPA <span class="required-star">*</span></label>
                                        <input type="text" name="gap" class="form-control"
                                            placeholder="e.g 3.23 or Very Good" value="{{ old('gap', $profile->gap) }}"
                                            required disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Age <span class="required-star">*</span></label>
                                        <input type="number" name="age" class="form-control" maxlength="2"
                                            placeholder="Your Age" value="{{ old('age', $profile->age) }}" required
                                            disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="gender" class="form-label">Gender <span
                                            class="required-star">*</span></label>
                                    <input list="gender-options" name="gender" id="gender" class="form-control"
                                        value="{{ old('gender', $profile->gender) }}" required disabled
                                        placeholder="Select or type gender">
                                    <datalist id="gender-options">
                                        <option value="Male"></option>
                                        <option value="Female"></option>
                                    </datalist>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>About Me <span class="required-star">*</span></label>
                                        <textarea name="about_me" class="form-control" maxlength="500" placeholder="About Me" required disabled>{{ old('about_me', $profile->about_me) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <!-- Additional Information -->
                            <div class="row">
                                <h3>Additional Information</h3>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Job Title</label>
                                        <input type="text" name="job_title" class="form-control"
                                            placeholder="Job Title" value="{{ old('job_title', $profile->job_title) }}"
                                            disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Language <span class="required-star">*</span></label>
                                        <input type="text" name="language" class="form-control"
                                            placeholder="Language" value="{{ old('language', $profile->language) }}"
                                            required disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Country <span class="required-star">*</span></label>
                                        <input type="text" name="country" class="form-control" placeholder="Country"
                                            value="{{ old('country', $profile->country) }}" required disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City <span class="required-star">*</span></label>
                                        <input type="text" name="city" class="form-control" placeholder="City"
                                            value="{{ old('city', $profile->city) }}" required disabled>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <!-- Social Information -->
                            <div class="row">
                                <h3>Social Information</h3>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>LinkedIn</label>
                                        <input type="text" name="linkedin" class="form-control"
                                            placeholder="www.linkedin.com/user"
                                            value="{{ old('linkedin', $profile->linkedin) }}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>GitHub</label>
                                        <input type="text" name="github" class="form-control"
                                            placeholder="www.github.com/user"
                                            value="{{ old('github', $profile->github) }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="button" id="edit-button" class="btn btn-success ">Edit</button>
                                <button type="submit" class="account-btn ">Save All</button>
                            </div>
                        </form>


                        <!-- Social Information End -->
                        <!-- ----------- Projects Information form ------------ -->
                        <div class="container mt-5">
                            @include('user.pages.profile.partials.Projects.Create_form_Projects')
                            <h3>Projects Information</h3>
                            <button onclick="openModalcreate_p()" type="button" class="btn btn-primary mb-3">
                                <i class="fas fa-plus"></i> Add Project
                            </button>

                            @include('user.pages.profile.partials.Projects.index_form_Projects')

                            @include('user.pages.profile.partials.Projects.Edit_form_Projects')








                        </div>


                        {{-- skill  --}}
                        <!-- Skills Information Form -->
                        <div class="container mt-5">
                            @include('user.pages.profile.partials.skills.Create_form_skills')
                            <h3>Skills Information</h3>
                            <button onclick="openModalCreateSkill()" type="button" class="btn btn-primary mb-3">
                                <i class="fas fa-plus"></i> Add Skill
                            </button>

                            @include('user.pages.profile.partials.skills.index_form_skills')

                            @include('user.pages.profile.partials.skills.Edit_form_skills')







                        </div>


                        <hr>
                        <!-- -- -----------Experiences Information form ---- -->
                        <div class="container mt-5">
                            @include('user.pages.profile.partials.Experiences.Create_form_Experiences')
                            <h3>Experiences Information</h3>
                            <button onclick="openExperienceModal()" type="button" class="btn btn-primary mb-3">
                                <i class="fas fa-plus"></i> Add Expertise
                            </button>
                            @include('user.pages.profile.partials.Experiences.Edit_form_Experiences')

                            @include('user.pages.profile.partials.Experiences.index_form_Experiences')







                        </div>

                        <!-- -- ----------- End Experiences Information form ---- -->
                        <hr>
                        <!-- -- -----------Certifications Information form ---- -->
                        <div class="container mt-5">
                            @include('user.pages.profile.partials.Certifications.Create_form_Certifications')
                            <h3>Certifications Information</h3>
                            <button onclick="openModalcreate()" type="button" class="btn btn-primary mb-3">
                                <i class="fas fa-plus"></i> Add Certification
                            </button>
                            @include('user.pages.profile.partials.Certifications.Edit_form_Certifications')

                            @include('user.pages.profile.partials.Certifications.index_form_Certifications')







                        </div>
                        <!-- -- ----------- End Certifications Information form ---- -->
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Account Area End -->

    <!-- Subscribe Section Start -->
    <section class="subscribe-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="section-title">
                        <h2>Get New Job Notifications</h2>
                        <p>Subscribe & get all related jobs notification</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <form class="newsletter-form" data-toggle="validator">
                        <input type="email" class="form-control" placeholder="Enter your email" name="EMAIL"
                            required autocomplete="off">

                        <button class="default-btn sub-btn" type="submit">
                            Subscribe
                        </button>

                        <div id="validator-newsletter" class="form-result"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Subscribe Section End -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- JavaScript to toggle edit mode -->
@endsection
