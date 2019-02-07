<!DOCTYPE html>
<html class="wide wow-animation" lang="{{ app()->getLocale() }}">
<head>
    <!-- Site Title-->
    <title>{{ @$title }} - {{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('/images/favicon.ico') }}" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato:400,400i,700,700i,900,900i">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">

    <!-- dedicated Css for a specific view -->
    @yield('dedicated_css')

    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="{{ asset('/js/html5shiv.min.js')}}"></script>
    <![endif]-->

    <!-- Alternate href lang-->
    <link rel="alternate" hreflang="es" href="{{ url()->current() }}"/>
</head>
<body>
<!-- ALL PAGES -->
<div class="page text-center">
@include('flash.flash')
    <!-- AllPages Header-->
    <header class="page-header">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap">
            <nav class="rd-navbar rd-navbar-light" data-lg-device-layout="rd-navbar-fixed" data-xl-device-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="1px" data-xl-stick-up-offset="1px" data-xxl-stick-up-offset="1px" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-fullwidth" data-xl-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static">
                <div class="rd-navbar-inner">
                    <!-- RD Navbar Panel-->
                    <div class="rd-navbar-panel">
                        <!-- RD Navbar Toggle-->
                        <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                        <!-- RD Navbar Brand-->
                        <div class="rd-navbar-brand rd-navbar-brand-desktop">
                            <a class="brand-name" href="/{{ App::getLocale() }}/">
                                <img width="150" src="/images/new-logo-hell-black.png" alt="">
                            </a>
                        </div>
                        <!-- RD Navbar Brand-->
                        <div class="rd-navbar-brand rd-navbar-brand-mobile">
                            <a class="brand-name" href="/{{ App::getLocale() }}/">
                                <img width="150" src="/images/new-logo-hell-black.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="rd-navbar-nav-wrap">
                        <!-- RD Navbar Nav-->
                        <ul class="rd-navbar-nav">
                            <li class="{{ @$activeVoyageCss }}">
                                <a href="/{{ App::getLocale() }}/voyages">Voyages</a>
                                <!-- RD Navbar Megamenu-->
                                @include('partials._megamenu_voyage')
                            </li>
                            <li class="{{ @$activeBlogCss }}">
                                <a href="/{{ App::getLocale() }}/blog">
                                    Blog
                                </a>
                            </li>
                            <li><a href="#">Pages</a>
                                <!-- RD Navbar Megamenu-->
                                <div class="rd-navbar-megamenu">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <p class="rd-megamenu-header text-big text-black text-ubold">Pages 1</p>
                                            <ul class="rd-megamenu-list">
                                                <li><a href="press.html">Press</a></li>
                                                <li><a href="services.html">Services</a></li>
                                                <li><a href="pricing.html">Pricing</a></li>
                                                <li><a href="destinations.html">Destinations</a></li>
                                                <li><a href="signup.html">Sign Up</a></li>
                                                <li><a href="signup-variant-2.html">Sign Up v2</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-4">
                                            <p class="rd-megamenu-header text-big text-black text-ubold">Pages 2</p>
                                            <ul class="rd-megamenu-list">
                                                <li><a href="login.html">Login</a></li>
                                                <li><a href="forgot-password.html">Forgot Password</a></li>
                                                <li><a href="privacy.html">Privacy Policy</a></li>
                                                <li><a href="terms-of-use.html">Terms Of Use</a></li>
                                                <li><a href="sitemap.html">Sitemap</a></li>
                                                <li><a href="search-results.html">Search Results</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-4">
                                            <p class="rd-megamenu-header text-big text-black text-ubold">Pages 3</p>
                                            <ul class="rd-megamenu-list">
                                                <li><a href="404.html">404</a></li>
                                                <li><a href="503.html">503</a></li>
                                                <li><a href="comingsoon.html">Coming Soon</a></li>
                                                <li><a href="maintenance.html">Maintenance</a></li>
                                                <li><a href="underconstruction.html">Under Construction</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="{{ @$activeContactCss }}">
                                <a href="/{{ App::getLocale() }}/contact">Contact</a>
                            </li>
                            <li class="language_selector">
                                @include('partials._language_selector')
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- User Menu & user Cart -->
    @include('partials._user_menu')

    <!-- Yield -->
    @yield('content')

    <!-- Modal cart -->
    @include('partials._modalcartfinal')

    <!-- Footer-->
    <footer class="page-footer footer-default section-top-80 section-bottom-34 section-lg-bottom-15 text-md-left">
        <div class="container">
            <div class="row justify-content-sm-center">
                <div class="col-md-8 col-lg-12">
                    <div class="row row-40 justify-content-sm-center">
                        <div class="col-md-6 col-lg-3 col-xl-4 order-lg-1">
                            <a class="brand-logo" href="index.html">
                                <img width="150" src="/images/new-logo-hell-black.png" alt="">
                            </a>
                            <p class="text-small inset-xl-right-80"> {{ __('home.footerbaseline') }}</p>
                        </div>
                        <div class="col-md-6 col-lg-3 col-xl-2 order-lg-4">
                            <p class="text-big text-black">{{ __('home.footerfollowUs') }}</p>
                            <!-- List Inline-->
                            <ul class="list-inline">
                                <li class="text-center"><a class="icon icon-square icon-filled-gallery fa fa-facebook text-gray" href="#"></a></li>
                                <li class="text-center"><a class="icon icon-square icon-filled-gallery fa fa-twitter text-gray" href="#"></a></li>
                                <li class="text-center"><a class="icon icon-square icon-filled-gallery fa fa-youtube text-gray" href="#"></a></li>
                                <li class="text-center"><a class="icon icon-square icon-filled-gallery fa fa-linkedin text-gray" href="#"></a></li>
                            </ul>
                            <!-- Button trigger modal-->
                            <button class="button button-primary" type="button" data-toggle="modal" data-target="#subscribe" style="min-width:160px;">{{ __('home.subscribe') }}</button>
                            <!-- Modal newsletter -->
                            @include('partials._newslettermodal')
                        </div>
                        <div class="col-sm-8 col-md-12 col-lg-6 order-lg-2">
                            <p class="text-big text-black">{{ __('home.contactus') }}</p>
                            <!-- Contact Info-->
                            <address class="contact-info text-left">
                                <div class="row row-15 justify-content-sm-center">
                                    <div class="col-md-6">
                                        <p class="d-block text-small contact-info-address">
                                            <a class="text-gray" href="#">
                                                    <span class="unit flex-row unit-spacing-xs">
                                                        <span class="unit-left">
                                                            <img class="img-responsive center-block" src="/images/icons/icon-01-16x21.png" width="16" height="21" alt="">
                                                        </span>
                                                        <span class="unit-body">
                                                            <span>{{ __('home.address') }} <br> {{ __('home.codepostal') }}</span>
                                                        </span>
                                                    </span>
                                            </a>
                                        </p>
                                        <p class="d-block text-small">
                                            <a class="text-gray" href="callto:#">
                                                    <span class="unit align-items-center flex-row unit-spacing-xs">
                                                        <span class="unit-left">
                                                            <img class="img-responsive center-block" src="/images/icons/icon-02-19x19.png" width="19" height="19" alt="">
                                                        </span>
                                                        <span class="unit-body">
                                                            <span>{{ __('home.phoneNumber') }}</span>
                                                        </span>
                                                    </span>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="d-block text-small">
                                            <a class="text-gray" href="callto:#">
                                                    <span class="unit align-items-center flex-row unit-spacing-xs">
                                                        <span class="unit-left">
                                                            <img class="img-responsive center-block" src="/images/icons/icon-03-12x20.png" width="12" height="20" alt="">
                                                        </span>
                                                        <span class="unit-body">
                                                            <span>{{ __('home.mobileNumber') }}</span>
                                                        </span>
                                                    </span>
                                            </a>
                                        </p>
                                        <p class="d-block text-small">
                                            <a class="text-gray" href="mailto:#">
                                                    <span class="unit align-items-center flex-row unit-spacing-xs">
                                                        <span class="unit-left">
                                                            <img class="img-responsive center-block" src="/images/icons/icon-04-20x13.png" width="20" height="13" alt="">
                                                        </span>
                                                        <span class="unit-body">
                                                            <span>{{ __('home.email') }}</span>
                                                        </span>
                                                    </span>
                                            </a>
                                        </p>
                                        <p class="d-block text-small">
                                            <a class="text-gray" href="{{ url(App::getLocale().'/') }}">
                                                    <span class="unit align-items-center flex-row unit-spacing-xs">
                                                        <span class="unit-left">
                                                            <img class="img-responsive center-block" src="/images/icons/icon-05-19x19.png" width="19" height="19" alt="">
                                                        </span>
                                                        <span class="unit-body">
                                                            <span>{{ __('home.rooturl') }}</span>
                                                        </span>
                                                    </span>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hr bg-gallery"></div>
            <div class="row row-0 justify-content-sm-center justify-content-md-between">
                <div class="col-md-5 col-lg-4 text-md-left">
                    <p class="text-extra-small">
                        {{ __('home.copyright') }} &#169; <span class="copyright-year"></span><a href="./"> EasyCopter</a></p>
                </div>
                <div class="col-md-5 col-lg-4 text-md-right">
                    <!-- List Inline-->
                    <ul class="list-inline list-inline-8">
                        <li>
                            <p class="text-extra-small"><a class="text-gray" href="privacy.html">{{ __('home.privacyPolicy') }}</a></p>
                        </li>
                        <li>
                            <p class="text-extra-small"><a class="text-gray" href="terms-of-use.html">{{ __('home.termsOfUse') }}</a></p>
                        </li>
                        <li>
                            <p class="text-extra-small"><a class="text-gray" href="{{ url()->route('contact', ['locale' => App::getLocale()]) }}">{{ __('home.contact') }}</a></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- Java script-->
<script src="{{ asset('js/core.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/cart.js') }}"></script>
<script type="text/javascript">
    cartJs.AddToCart();
    cartJs.ResponseAfterSubmit();
    cartJs.RemoveFromCart();
    cartJs.UpdateQuantity();

    $(document).ready(function () {
        var language_Selector = $('.language_selector');
        language_Selector.on('mouseover', function (e) {
            e.preventDefault();
            var langueDiv = $('.languages_items');
            langueDiv.css({'display':'block', 'width':'25px'});
        });

        language_Selector.on('mouseout', function (e) {
            e.preventDefault();
            var langueDiv = $('.languages_items');
            langueDiv.css({'display':'none'});
        });
    });
</script>
<!-- dedicated Javascript for a specific view -->
@yield('dedicated_js')
</body>
</html>