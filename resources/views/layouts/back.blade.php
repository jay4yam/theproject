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
    <meta name="robots" content="noindex,nofollow">
    <link rel="icon" href="{{ asset('/images/favicon.ico') }}" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato:400,400i,700,700i,900,900i">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
                                <a href="{{ url()->route('back.index') }}">Dashboard</a>
                            </li>
                            <li class="{{ @$voyageCssActive }}"><a href="{{ route('voyages.index') }}">Voyages</a>
                                <!-- RD Navbar Dropdown-->
                                <ul class="rd-navbar-dropdown">
                                    <li><a href="{{ route('voyages.create') }}">Ajouter</a></li>
                                    <li><a href="{{ url()->route('regions.index') }}">Region</a></li>
                                    <li><a href="{{ url()->route('villes.index') }}">Villes</a></li>
                                </ul>
                            </li>
                            <li class="{{ @$compagnyCssActive }}"><a href="/{{ \App::getLocale() }}/admin/compagnies">Compagnies</a>
                                <!-- RD Navbar Dropdown-->
                                <ul class="rd-navbar-dropdown">
                                    <li><a href="/{{ App::getLocale() }}/admin/compagnies">Liste</a></li>
                                    <li><a href="/{{ App::getLocale() }}/admin/compagnies/create">Ajouter</a></li>
                                </ul>
                            </li>
                            <li class="{{ @$userCssActive }}"><a href="/{{ App::getLocale() }}/admin/users">Utilisateurs</a>
                                <!-- RD Navbar Dropdown-->
                                <ul class="rd-navbar-dropdown">
                                    <li><a href="/{{ App::getLocale() }}/admin/users">Liste</a></li>
                                    <li><a href="/{{ App::getLocale() }}/admin/users/create">Ajouter</a></li>
                                </ul>
                            </li>
                            <li class="{{ @$blogCssActive }}"><a href="{{ route('blogs.index') }}">Blogs</a>
                                <!-- RD Navbar Dropdown-->
                                <ul class="rd-navbar-dropdown">
                                    <li><a href="{{ route('blogs.index') }}">Liste</a></li>
                                    <li><a href="{{ route('blogs.create') }}">Ajouter</a></li>
                                    <li class="{{ @$blogCommentActive }}">
                                        <a href="{{ route('comments.index') }}">Commentaires</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="{{ @$seoCssActive }}">
                                <a href="{{ route('seo.index') }}">SEO</a>
                            </li>
                            @guest
                                <li><a href="{{ route('login') }}">Login</a></li>
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

<!-- Javascript-->
<script src="{{ asset('js/core.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- modal flash message -->
<script>
    $(document).ready(function () {
        $('#flash-overlay-modal').modal();
        //$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    });
</script>
<!-- dedicated Javascript for a specific view -->
@yield('dedicated_js')
</body>
</html>