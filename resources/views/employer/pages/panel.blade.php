@extends('employer.control_panel')

@section('content')
    @include('employer.partials.navbar')
    <!--**********************************
                                Nav header end
                            ***********************************-->

    <!--**********************************
                                Sidebar start
                            ***********************************-->
    @include('employer.partials.sidebar')

    <!--**********************************
                                Main Content
                            ***********************************-->
    @yield('maincontent')
    @include('employer.partials.form_add_job')
@endsection
