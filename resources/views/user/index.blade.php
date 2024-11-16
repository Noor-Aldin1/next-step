<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('customer_css/assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ url('customer_css/assets/css/owl.carousel.min.css') }}">

    <!-- Owl Carousel Theme Default CSS -->
    <link rel="stylesheet" href="{{ url('customer_css/assets/css/owl.theme.default.min.css') }}">

    <!-- Box Icon CSS -->
    <link rel="stylesheet" href="{{ url('customer_css/assets/css/boxicon.min.css') }}">

    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ url('customer_css/assets/fonts/flaticon/flaticon.css') }}">

    <!-- Magnific CSS -->
    <link rel="stylesheet" href="{{ url('customer_css/assets/css/magnific-popup.css') }}">

    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{ url('customer_css/assets/css/meanmenu.css') }}">

    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ url('customer_css/assets/css/nice-select.css') }}">

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ url('customer_css/assets/css/style.css') }}">

    <!-- Dark CSS -->
    <link rel="stylesheet" href="{{ url('customer_css/assets/css/dark.css') }}">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ url('customer_css/assets/css/responsive.css') }}">

    <!-- Title -->
    <title>NextStep - Customer</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ url('customer_css/assets/img/favicon.png') }}">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    {{-- fontisewom --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- scroll dropdown --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- ---Select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


    {{-- style profile  --}}
    <link rel="stylesheet" href="{{ url('profile/profile_input/profile.css') }}">
    {{-- Live chat --}}

    <!-- Smartsupp Live Chat script -->
    <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
        _smartsupp.key = '440c1a3dd4819703992098ca5b2f026995feef52';

        @if (session('user_logged_in')) // Check if the user is logged in (modify session key accordingly)
            _smartsupp.customMessage =
            'Hello, {{ session('user_name') }}! How can we assist you today?'; // Display custom message with user's name
        @else
            _smartsupp.customMessage = 'Hello! How can we help you today?'; // Default message for guests
        @endif

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

    <noscript>
        Powered by <a href="https://www.smartsupp.com" target="_blank">Smartsupp</a>
    </noscript>

</head>

<body>

    </script>
    @auth
        @include('user.partials.index_after_login')
    @else
        @include('user.partials.navbar')
    @endauth
    @yield('content')

    @include('user.partials.footer')
    {{-- @include('translate') --}}
