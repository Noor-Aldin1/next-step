<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Smarthr - Bootstrap Admin Template" />
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects" />
    <meta name="author" content="Dreamstechnologies - Bootstrap Admin Template" />
    <!-- Title -->
    <title>NextStep - Admin</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ url('customer_css/assets/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('admin_css/assets/css/bootstrap.min.css') }}" />

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ url('admin_css/assets/plugins/fontawesome/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ url('admin_css/assets/plugins/fontawesome/css/all.min.css') }}" />

    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="{{ url('admin_css/assets/css/line-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ url('admin_css/assets/css/material.css') }}" />

    <!-- Chart CSS -->
    <link rel="stylesheet" href="{{ url('admin_css/assets/plugins/morris/morris.css') }}" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ url('admin_css/assets/css/style.css') }}" />
    <!-- Remember to include jQuery :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.css" />
    <!-- SweetAlert2 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.js"></script>
    {{-- ---------------Datepicker  --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    {{-- live chat --}}

    <!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
        _smartsupp.key = '440c1a3dd4819703992098ca5b2f026995feef52';
        window.smartsupp || (function(d) {
            var s, c, o = smartsupp = function() {
                o._.push(arguments)
            };
            o._ = [];
            s = d.getElementsByTagName('script')[0];
            c = d.createElement('script');
            c.type = 'text/javascript';
            c.charset = 'utf-8';
            c.async = true;
            c.src = 'https://www.smartsuppchat.com/loader.js?';
            s.parentNode.insertBefore(c, s);
        })(document);
    </script>
    <noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>
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
    <div class="main-wrapper">
        @include('admin.partials.navbar')

        @include('admin.partials.sidebar')
        @yield('content')
    </div>
    <!-- jQuery -->
    <script data-cfasync="false"
        src="{{ url('admin_css/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"></script>
    <script src="{{ url('admin_css/assets/js/jquery-3.7.1.min.js') }}" type="ffe3e4516ad90e9c3d627842-text/javascript"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Core JS -->
    <script src="{{ url('admin_css/assets/js/bootstrap.bundle.min.js') }}" type="ffe3e4516ad90e9c3d627842-text/javascript"></script>

    <!-- Slimscroll JS -->
    <script src="{{ url('admin_css/assets/js/jquery.slimscroll.min.js') }}" type="ffe3e4516ad90e9c3d627842-text/javascript"></script>

    <!-- Chart JS -->
    <script src="{{ url('admin_css/assets/plugins/morris/morris.min.js') }}" type="ffe3e4516ad90e9c3d627842-text/javascript"></script>
    <script src="{{ url('admin_css/assets/plugins/raphael/raphael.min.js') }}" type="ffe3e4516ad90e9c3d627842-text/javascript"></script>
    <script src="{{ url('admin_css/assets/js/chart.js') }}" type="ffe3e4516ad90e9c3d627842-text/javascript"></script>
    <script src="{{ url('admin_css/assets/js/greedynav.js') }}" type="ffe3e4516ad90e9c3d627842-text/javascript"></script>

    <!-- Theme Settings JS -->
    <script src="{{ url('admin_css/assets/js/layout.js') }}" type="ffe3e4516ad90e9c3d627842-text/javascript"></script>
    <script src="{{ url('admin_css/assets/js/theme-settings.js') }}" type="ffe3e4516ad90e9c3d627842-text/javascript"></script>

    <!-- Custom JS -->
    <script src="{{ url('admin_css/assets/js/app.js') }}" type="ffe3e4516ad90e9c3d627842-text/javascript"></script>

    <script src="{{ url('admin_css/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}"
        data-cf-settings="ffe3e4516ad90e9c3d627842-|49" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- ------------Font Icon --------------- --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



</body>

</html>
