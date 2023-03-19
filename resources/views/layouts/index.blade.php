<?php
/**
 * Created by PhpStorm.
 * User: muturi muraya <muturi.muraya@gmail.com>
 * Date: 07/09/2021
 * Time: 8:46 PM
 * Project kouponzetu
 */
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Affan - PWA Mobile HTML Template">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KouponZetu') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">
    <link rel="apple-touch-icon" href="img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icons/icon-180x180.png">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('affan/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('affan/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('affan/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('affan/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('affan/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('affan/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('affan/css/ion.rangeSlider.min.css') }}">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{ asset('affan/style.css') }}">

    <!-- All JavaScript Files -->
    <script src="{{ asset('affan/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('affan/js/jquery.min.js') }}"></script>
    <script src="{{ asset('affan/js/internet-status.js') }}"></script>
    <script src="{{ asset('affan/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('affan/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('affan/js/wow.min.js') }}"></script>
    <script src="{{ asset('affan/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('affan/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('affan/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('affan/js/ion.rangeSlider.min.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
    <!--[if (lt IE 9)]><script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.helper.ie8.js"></script><![endif]-->

    <link rel="stylesheet" type="text/css" href="{{asset("vendor/cookie-consent/css/cookie-consent.css")}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('affan/product-card.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    @livewireStyles


    <style>
        .profile-head {
            transform: translateY(7rem)
        }

        .cover {
            /*background-image: url(https://images.unsplash.com/photo-1461988320302-91bde64fc8e4);*/
            background-size: cover;
            background-repeat: no-repeat
        }
        #map-canvas {
            width: 100%;
            height: 70vh;
            float: none;
            margin: auto;
            border: none;
        }
    </style>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-TXPFHDJ');</script>


</head>
<body>
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TXPFHDJ"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>

<!-- Internet Connection Status -->
<!-- # This code for showing internet connection status -->
<div class="internet-connection-status" id="internetStatus"></div>
<!-- Header Area -->
<div class="header-area" id="headerArea">
    <div class="container">
        <!-- # Paste your Header Content from here -->
        <!-- # Header Five Layout -->
        <!-- # Copy the code from here ... -->
        <!-- Header Content -->
        <div
            class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
            <!-- Logo Wrapper -->
            <div class="logo-wrapper"><a href="{{ url("") }}">
                    <img src="{{asset('slim-logo.png')}}" style="height: 80px !important;"></a></div>
            <!-- Navbar Toggler -->
            <div class="navbar--toggler" id="affanNavbarToggler" data-bs-toggle="offcanvas"
                 data-bs-target="#affanOffcanvas" aria-controls="affanOffcanvas">
                <span class="d-block"></span><span class="d-block"></span><span class="d-block"></span>
            </div>
        </div>
        <!-- # Header Five Layout End -->
    </div>
</div>
<!-- # Sidenav Left -->
<!-- Offcanvas -->
<div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1"
     aria-labelledby="affanOffcanvsLabel">
    <button class="btn-close btn-close text-reset" type="button" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    <div class="offcanvas-body p-0">
        <!-- Side Nav Wrapper -->
        <div class="sidenav-wrapper">
            <!-- Sidenav Nav -->
            <ul class="sidenav-nav ps-0">
                <li><a href="{{ url('/') }}">
                        <svg class="bi bi-house-door" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"></path>
                            <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"></path>
                        </svg>
                        Home
                    </a>
                </li>

                <li>
                    <a href="{{ route('my.orders') }}">
                        <i class="bi bi-bag "></i>
                        &nbsp;&nbsp;&nbsp;&nbsp; My Deals
                    </a>
                </li>

                @if(\Illuminate\Support\Facades\Auth::check())
                    <li><a href="{{ route('my.profile') }}">
                            <i class="bi bi-person-fill"></i>
                            &nbsp;&nbsp;&nbsp;&nbsp; Profile</a></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-arrow-return-left"></i>
                            &nbsp;&nbsp;&nbsp;&nbsp; Logout
                        </a>
                    </li>
                    <form method="POST" id="logout-form" action="{{ route('logout') }}">
                        @csrf
                    </form>
                @else
                    <li>
                        <a href="{{ route('login') }}">
                            <i class="bi bi-door-open"></i>
                            &nbsp;&nbsp;&nbsp;&nbsp; Login</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}">
                            <i class="bi bi-person-plus-fill"></i>
                            &nbsp;&nbsp;&nbsp;&nbsp; Register</a>
                    </li>
                @endif
            </ul>
            <hr class="mx-4">
            <ul class="list-unstyled m-4">
                <li><a href="{{ route('policy.show') }}" class="text-muted">Privacy Policy</a></li>
                <li><a href="{{ route('refund') }}" class="text-muted">Refund Policy</a></li>
                <li> <a href="{{ route('terms.show') }}" class="text-muted">Terms of Service</a></li>
                <li> <a href="htts://www.kouponzetu.com" class="text-muted">FAQ</a></li>
            </ul>

            <!-- Social Info -->
            <div class="social-info-wrap m-4">
                <a href="https://www.facebook.com/KouponZetu.KE/" target="_blank"><i class="bi bi-facebook"></i></a>
                <a href="https://twitter.com/kouponzetu?lang=el" target="_blank"><i class="bi bi-twitter"></i></a>
                <a href="https://ke.linkedin.com/in/kouponzetu-coupons-600a54188" target="_blank"><i class="bi bi-linkedin"></i></a>
                <a href="https://www.instagram.com/kouponzetu/?hl=en" target="_blank"><i class="bi bi-instagram"></i></a>
            </div>
            <!-- Copyright Info -->
            <div class="copyright-info">
                <p>{{ date('Y') }} &copy;</p>
            </div>
        </div>
    </div>
</div>
<div class="page-content-wrapper">
    <div class="pt-2"></div>

    {{ $slot ?? '' }}
    @yield('content')

    <div class="pb-3"></div>
</div>


<!-- Footer Nav -->
<div class="footer-nav-area mt-3" id="footerNav">
    <div class="container px-0">
        <!-- Footer Content -->
        <div class="footer-nav position-relative">
            <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
                <li class="{{ (request()->is('/')) ? 'active' : '' }}">
                    <a href="{{ url('/') }}">
                        <svg class="bi bi-house" width="20" height="20" viewBox="0 0 16 16" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"></path>
                            <path fill-rule="evenodd"
                                  d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"></path>
                        </svg>
                        <span>Home</span>
                    </a>
                </li>
                <li class="{{ (request()->is('maduka*')) ? 'active' : '' }}">
                    <a href="{{ route('maduka') }}">
                        <svg class="bi bi-collection" width="20" height="20" viewBox="0 0 16 16" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"></path>
                        </svg>
                        <span>Shops</span>
                    </a>
                </li>
                <li class="{{ (request()->is('categories*')) ? 'active' : '' }}">
                    <a href="{{ route('shop.categories') }}">
                        <svg class="bi bi-folder2-open" width="20" height="20" viewBox="0 0 16 16" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"></path>
                        </svg>
                        <span>Category</span>
                    </a>
                </li>
                <li class="{{ (request()->is('special-deals*')) ? 'active' : '' }}">
                    <a href="{{ route('special-deals') }}">
                        <svg class="bi bi-chat-dots" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                             fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path>
                            <path
                                d="M2.165 15.803l.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"></path>
                        </svg>
                        <span>Special Deals</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}">
                        <svg class="bi bi-gear" width="20" height="20" viewBox="0 0 16 16" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"></path>
                            <path fill-rule="evenodd"
                                  d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"></path>
                        </svg>
                        <span>My Account</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<script src="{{ asset('affan/js/active.js') }}"></script>

<!-- PWA -->
<script src="{{ asset('affan/js/pwa.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@livewireScripts
@stack('scripts')
@include('includes.firebase')
@include('includes.notification-scripts')



<script>
    Livewire.on('pay-modal', event => {
        $('#payModal').modal('show');
    })
    Livewire.on('re-calc', event => {

        document.getElementById(event[0]).innerHTML="calculating .. "
        var countDownDate = new Date(event[1]).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById(event[0]).innerHTML = '<i class="bi bi-alarm me-2 mr-2"></i>' + days + "d " + hours + "h "
                + minutes + "m " + seconds + "s " +"Remaining";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById(event[0]).innerHTML = "EXPIRED";
            }
        }, 1000);
    })

    function cal() {
        document.getElementById(event[0]).innerHTML="calculating .. "
        var countDownDate = new Date(event[1]).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById(event[0]).innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s " +"Remaining";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById(event[0]).innerHTML = "EXPIRED";
            }
        }, 1000);
    }
</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/62078152b9e4e21181bec120/1frml2aov';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->

</body>
</html>
