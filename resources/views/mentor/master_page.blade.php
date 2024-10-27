<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Edumin - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('mentors_css/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ url('mentors_css/vendor/jqvmap/css/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ url('mentors_css/vendor/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ url('mentors_css/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ url('mentors_css/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('mentors_css/css/skin-2.css') }}">
    <link rel="stylesheet" href="{{ url('mentors_css/vendor/fullcalendar/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ url('mentors_css/vendor/select2/css/select2.min.css') }}">


    {{-- <link rel="stylesheet" href="https://cdn.mobiscroll.com/5.0.1/css/mobiscroll.min.css" />
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ url('assets/jQuery.js') }}"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js') }}"></script>

</head>
{{-- --------style select2 -------- --}}
<style>
    .select2-container--default .select2-selection--single {
        border: 1px solid #ced4da;
        /* Border color */
        border-radius: 0.25rem;
        /* Rounded corners */
        height: calc(2.25rem + 2px);
        /* Height */
        transition: background-color 0.3s;
        /* Smooth transition for background color */
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 2.25rem;
        /* Center text vertically */
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 2.25rem;
        /* Arrow height */
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        border-color: transparent transparent #007bff transparent;
        /* Arrow color */
    }

    /* Hover effect for the selection box */
    .select2-container--default .select2-selection--single:hover {
        background-color: #6673fd;
        /* Background color on hover */
        color: white;
        /* Text color on hover */
    }

    /* Hover effect for dropdown options */
    .select2-container--default .select2-results__option--highlighted {
        background-color: #6673fd;
        /* Background color for highlighted option */
        color: white;
        /* Text color for highlighted option */
    }
</style>

<body>



    @include('mentor.partials.navbar')

    @include('mentor.partials.sidebar')




    @yield('content')







    <!--**********************************
    Scripts
***********************************-->
    <!-- Required vendors -->


    <script src="{{ url('mentors_css/vendor/fullcalendar/js/fullcalendar.min.js') }}"></script>
    <script src="{{ url('mentors_css/js/plugins-init/fullcalendar-init.js') }}"></script>
    <script src="{{ url('mentors_css/vendor/global/global.min.js') }}"></script>
    <script src="{{ url('mentors_css/vendor/jqueryui/js/jquery-ui.min.js') }}"></script>
    <script src="{{ url('mentors_css/vendor/moment/moment.min.js') }}"></script>
    <script src="{{ url('mentors_css/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ url('mentors_css/js/custom.min.js') }}"></script>
    <script src="{{ url('mentors_css/js/dlabnav-init.js') }}"></script>

    <!-- Chart ChartJS plugin files -->
    <script src="{{ url('mentors_css/vendor/chart.js/Chart.bundle.min.js') }}"></script>

    <!-- Chart piety plugin files -->
    <script src="{{ url('mentors_css/vendor/peity/jquery.peity.min.js') }}"></script>

    <!-- Chart sparkline plugin files -->
    <script src="{{ url('mentors_css/vendor/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Demo scripts -->
    <script src="{{ url('mentors_css/js/dashboard/dashboard-3.js') }}"></script>

    <!-- Svganimation scripts -->
    <script src="{{ url('mentors_css/vendor/svganimation/vivus.min.js') }}"></script>
    <script src="{{ url('mentors_css/vendor/svganimation/svg.animation.js') }}"></script>
    <script src="{{ url('mentors_css/js/styleSwitcher.js') }}"></script>

    {{-- -------------select 2 ---------------- --}}
    <script src="{{ url('mentors_css/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ url('mentors_css/js/plugins-init/select2-init.js') }}"></script>









</body>

</html>
