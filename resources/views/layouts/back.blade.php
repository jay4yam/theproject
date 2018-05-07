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
                                <img width="148" height="30" src="/images/logo-dark-148x30.png" alt="">
                            </a>
                        </div>
                        <!-- RD Navbar Brand-->
                        <div class="rd-navbar-brand rd-navbar-brand-mobile">
                            <a class="brand-name" href="/{{ App::getLocale() }}/">
                                <img width="148" height="30" src="/images/logo-dark-148x30.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="rd-navbar-nav-wrap">
                        <!-- RD Navbar Nav-->
                        <ul class="rd-navbar-nav">
                            <li>
                                <a href="{{ url('/') }}">Dashboard</a>
                            </li>
                            <li><a href="/{{ \App::getLocale() }}/admin/compagny">Compagnies</a>
                            </li>
                            <li><a href="about.html">About</a>
                                <!-- RD Navbar Dropdown-->
                                <ul class="rd-navbar-dropdown">
                                    <li><a href="our-team.html">Our Team</a></li>
                                    <li><a href="careers.html">Careers</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                    <li><a href="testimonials.html">Testimonials</a></li>
                                </ul>
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
                            <li><a href="gallery-cobbles.html">Gallery</a>
                                <!-- RD Navbar Dropdown-->
                                <ul class="rd-navbar-dropdown">
                                    <li><a href="gallery-cobbles.html">Gallery Cobbles</a></li>
                                    <li><a href="gallery-fullwidth.html">Gallery Fullwidth</a></li>
                                    <li><a href="gallery-grid.html">Gallery Grid</a></li>
                                    <li><a href="gallery-masonry.html">Gallery Masonry</a></li>
                                </ul>
                            </li>
                            <li><a href="blog-grid.html">Blog</a>
                                <!-- RD Navbar Dropdown-->
                                <ul class="rd-navbar-dropdown">
                                    <li><a href="blog-grid.html">Blog Grid</a></li>
                                    <li><a href="blog-grid-sidebar-left.html">Blog Grid Sidebar</a></li>
                                    <li><a href="blog-list.html">Blog List</a></li>
                                    <li><a href="blog-list-sidebar-left.html">Blog List Sidebar</a></li>
                                    <li><a href="blog-list-variant-2.html">Blog List v2</a></li>
                                    <li><a href="blog-list-variant-2-sidebar-left.html">Blog List v2 Sidebar</a></li>
                                    <li><a href="blog-masonry.html">Blog Masonry</a></li>
                                    <li><a href="blog-modern.html">Blog Modern</a></li>
                                    <li><a href="blog-single-post.html">Blog Single Post</a></li>
                                    <li><a href="blog-single-post-sidebar-left.html">Blog Single Post Sidebar</a></li>
                                </ul>
                            </li>
                            <li><a href="contacts.html">Contacts</a>
                                <!-- RD Navbar Dropdown-->
                                <ul class="rd-navbar-dropdown">
                                    <li><a href="contacts.html">Contacts</a></li>
                                    <li><a href="contacts-variant-2.html">Contacts v2</a></li>
                                </ul>
                            </li>
                            @guest
                                <li class="active"><a href="{{ route('login') }}">Login</a></li>
                                @else
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                    @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- Yield -->
@yield('content')


    <!-- Footer-->
    <footer class="page-footer footer-default section-top-80 section-bottom-34 section-lg-bottom-15 text-md-left">
        <div class="container">
            <div class="row row-0 justify-content-sm-center justify-content-md-between">
                <div class="col-md-5 col-lg-4 text-md-left">
                    <p class="text-extra-small">
                        {{ __('home.copyright') }} &#169; <span class="copyright-year"></span>
                        <a href="/{{ \App::getLocale() }}/"> EasyCopter</a>
                    </p>
                </div>
                <div class="col-md-5 col-lg-4 text-md-right">
                    <!-- List Inline-->
                    <ul class="list-inline list-inline-8">
                        <li>
                            <p class="text-extra-small">
                                <a class="text-gray" href="/{{ \App::getLocale() }}/">
                                    {{ __('admin.admin_retour_au_site') }}
                                </a>
                            </p>
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

</body>
</html>