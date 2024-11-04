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
    <title>Dashboard - HRMS admin template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('admin_css/assets/img/favicon.png') }}" />

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
</head>
<style>
    /* style model in job list  */
    .custom-grid-badges {
        display: flex;
        gap: 10px;
        margin-top: 1rem;
    }

    .custom-badge {
        padding: 0.5rem 1rem;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        font-weight: bold;
    }

    .custom-bg-danger {
        background-color: #dc3545;
        color: white;
    }

    .custom-bg-purple {
        background-color: #6f42c1;
        color: white;
    }

    .custom-modal {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        padding: 2rem;
        border-radius: 8px;
        max-width: 500px;
        width: 90%;
        z-index: 1000;
    }

    .custom-modal h6 {
        margin-top: 0;
    }

    .custom-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    /* ------------ */
    .view-icons {
        display: flex;
        /* Use flexbox for alignment */
        align-items: center;
        /* Center items vertically */
        gap: 8px;
        /* Add space between text and icon */
    }

    .clear-filter-text {
        font-weight: bold;
        /* Make the text bold */
        font-size: 14px;
        /* Adjust font size as needed */
        color: #333;
        /* Change text color as desired */
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
</body>

</html>
