<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- Title -->
    <title>NextStep - Mentor</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ url('customer_css/assets/img/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ url('mentors_css/vendor/jqvmap/css/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ url('mentors_css/vendor/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ url('mentors_css/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ url('mentors_css/vendor/fullcalendar/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ url('mentors_css/vendor/select2/css/select2.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ url('mentors_css/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('mentors_css/css/skin-2.css') }}">


    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="{{ url('assets/jQuery.js') }}"></script>

    <!-- FullCalendar -->
    <script src="{{ url('https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js') }}"></script>

    <!-- Mobiscroll JavaScript (included after the main scripts) -->
    <link rel="stylesheet" href="{{ asset('event/css/mobiscroll.min.css') }}">
    <script src="{{ asset('event/mobiscroll.jquery.min.js') }}"></script>
    <link href="event/css/mobiscroll.jquery.min.css" rel="stylesheet" />
    <script src="event/js/mobiscroll.jquery.min.js"></script>
    {{-- --------- Custom Styles for Select2 --------- --}}
    <style>
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            height: calc(2.25rem + 2px);
            transition: background-color 0.3s;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 2.25rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 2.25rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent #007bff transparent;
        }

        .select2-container--default .select2-selection--single:hover {
            background-color: #6673fd;
            color: white;
        }

        .select2-container--default .select2-results__option--highlighted {
            background-color: #6673fd;
            color: white;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<style>
    /* Overall Container */
    .booking-container {
        border: 1px solid #007bff;
        border-radius: 12px;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Date Input */
    #start-session-datepicker,
    #end-session-datepicker {
        width: 100%;
        padding: 12px;
        border: 2px solid #007bff;
        border-radius: 8px;
        font-size: 16px;
        transition: border-color 0.3s, box-shadow 0.3s;
        margin-bottom: 20px;
    }

    #start-session-datepicker:focus,
    #end-session-datepicker:focus {
        border-color: #0056b3;
        outline: none;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
    }

    /* Time Slot Styles */
    .time-slot {
        cursor: pointer;
        padding: 12px 15px;
        display: inline-block;
        margin: 5px;
        border: 2px solid #007bff;
        border-radius: 8px;
        background-color: #f1f1f1;
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        text-align: center;
        width: 80px;
        /* Set a fixed width for better alignment */
        font-weight: bold;
        color: #333;
        font-size: 14px;
    }

    .time-slot.disabled {
        background-color: #e9ecef;
        color: #ccc;
        cursor: not-allowed;
    }

    .time-slot:hover:not(.disabled) {
        background-color: #e1f5fe;
        border-color: #0056b3;
    }

    .time-slot.selected {
        background-color: #007bff;
        /* Change background color when selected */
        color: white;
        /* Change text color when selected */
        border: 2px solid #0056b3;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
    }

    /* Label Styles */
    .control-label {
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 18px;
        color: #007bff;
    }

    /* Time Slots Container */
    .time-slots {
        margin-top: 10px;
        display: flex;
        flex-wrap: wrap;
        /* Allow time slots to wrap */
        gap: 10px;
        /* Add space between time slots */
        max-height: 200px;
        /* Set a max height for the container */
        overflow-y: auto;
        /* Enable vertical scrolling */
        padding: 10px;
        border: 1px solid #007bff;
        border-radius: 8px;
        background-color: #f8f9fa;
        /* Background color for the slots container */
    }
</style>

<body>

    @include('mentor.partials.navbar') <!-- Include the navigation bar -->

    @include('mentor.partials.sidebar') <!-- Include the sidebar -->

    @yield('content') <!-- Placeholder for the main content -->

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

    <!-- Chart.js plugin files -->
    <script src="{{ url('mentors_css/vendor/chart.js/Chart.bundle.min.js') }}"></script>

    <!-- Chart piety plugin files -->
    <script src="{{ url('mentors_css/vendor/peity/jquery.peity.min.js') }}"></script>

    <!-- Chart sparkline plugin files -->
    <script src="{{ url('mentors_css/vendor/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Demo scripts -->
    <script src="{{ url('mentors_css/js/dashboard/dashboard-3.js') }}"></script>

    <!-- SVG animation scripts -->
    <script src="{{ url('mentors_css/vendor/svganimation/vivus.min.js') }}"></script>
    <script src="{{ url('mentors_css/vendor/svganimation/svg.animation.js') }}"></script>
    <script src="{{ url('mentors_css/js/styleSwitcher.js') }}"></script>

    {{-- Select2 Initialization --}}
    <script src="{{ url('mentors_css/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ url('mentors_css/js/plugins-init/select2-init.js') }}"></script>

</body>

</html>
