@extends('mentor.master_page')
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Edit Course</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('courses.student.index') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Courses</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Edit Course</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Course Details</h4>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('courses.student.update', $course->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Use PUT method for updating -->

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" for="course-name">Course Name</label>
                                            <input type="text" id="course-name" name="title" class="form-control"
                                                value="{{ old('title', $course->title) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" for="student-select">Choose Student</label>
                                            <select id="student-select" name="student" class="form-control select2"
                                                required>
                                                <option selected disabled value="">Choose Names</option>
                                                @foreach ($usernames as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ $course->student_id == $user->id ? 'selected' : '' }}>
                                                        {{ $user->username }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" for="course-details">Course Details</label>
                                            <textarea id="course-details" name="description" class="form-control" rows="5" required>{{ old('description', $course->description) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group fallback w-100">
                                            <label class="form-label d-block">Course Photo</label>
                                            <input type="file" name="photo" class="dropify"
                                                data-default-file="{{ $course->photo ? asset('storage/' . $course->photo) : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('courses.index') }}" class="btn btn-light">Cancel</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
