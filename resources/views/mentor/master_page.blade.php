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


    {{-- <link rel="stylesheet" href="https://cdn.mobiscroll.com/5.0.1/css/mobiscroll.min.css" />
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ url('assets/jQuery.js') }}"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js') }}"></script>

</head>

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
