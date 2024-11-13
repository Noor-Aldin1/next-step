<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="NoorAldin" content="NextStep">
    <meta name="robots" content="index, follow">
    <meta name="keywords"
        content="employer dashboard, job marketplace, mentorship platform, user profiles, job search, subscription plans, career development, responsive web app">
    <meta name="description"
        content="Introducing our innovative employer dashboard designed to connect inexperienced individuals and recent graduates with experienced mentors, facilitating a smooth transition into the job market.">
    <meta property="og:title" content="Employer Dashboard: Your Gateway to Connecting Talent">
    <meta property="og:description"
        content="Join our platform to provide mentorship and job opportunities while helping users enhance their skills and achieve career goals.">
    <meta property="og:image" content="https://yourdomain.com/path/to/your/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Employer-NextStep</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Favicon icon -->



    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ url('customer_css/assets/img/favicon.png') }}">

    <!-- All StyleSheet -->
    <link rel="stylesheet" href="{{ url('employer_css/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ url('employer_css/vendor/owl-carousel/owl.carousel.css') }}">

    <!-- Global CSS -->
    <link rel="stylesheet" href="{{ url('employer_css/css/style.css') }}">

    {{-- font icon  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


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



@yield('content')





















<!--**********************************
 Scripts
***********************************-->
<!-- Required Vendors -->
<script src="{{ url('employer_css/vendor/global/global.min.js') }}"></script>
<script src="{{ url('employer_css/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>

<!-- Charting Libraries -->
<script src="{{ url('employer_css/vendor/apexchart/apexchart.js') }}"></script>
<script src="{{ url('employer_css/vendor/chartjs/chart.bundle.min.js') }}"></script>

<!-- Piety Chart Plugin -->
<script src="{{ url('employer_css/vendor/peity/jquery.peity.min.js') }}"></script>

<!-- Dashboard Scripts -->
<script src="{{ url('employer_css/js/dashboard/dashboard-1.js') }}"></script>

<!-- Owl Carousel Plugin -->
<script src="{{ url('employer_css/vendor/owl-carousel/owl.carousel.js') }}"></script>

<!-- Custom Scripts -->
<script src="{{ url('employer_css/js/custom.min.js') }}"></script>
<script src="{{ url('employer_css/js/dlabnav-init.js') }}"></script>

<script>
    function JobickCarousel() {

        /*  testimonial one function by = owl.carousel.js */
        jQuery('.front-view-slider').owlCarousel({
            loop: false,
            margin: 30,
            nav: true,
            autoplaySpeed: 3000,
            navSpeed: 3000,
            autoWidth: true,
            paginationSpeed: 3000,
            slideSpeed: 3000,
            smartSpeed: 3000,
            autoplay: false,
            animateOut: 'fadeOut',
            dots: true,
            navText: ['', ''],
            responsive: {
                0: {
                    items: 1,

                    margin: 10
                },

                480: {
                    items: 1
                },

                767: {
                    items: 3
                },
                1750: {
                    items: 3
                }
            }
        })
    }

    jQuery(window).on('load', function() {
        setTimeout(function() {
            JobickCarousel();
        }, 1000);
    });
</script>


</body>

</html>
