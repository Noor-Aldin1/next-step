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

</head>

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
