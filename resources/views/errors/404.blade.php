@extends('layouts.other', ['title' => 'Page introuvable'])

@section('content')
    <section class="section parallax-container bg-black" data-parallax-img="/images/backgrounds/background-15-1920x900.jpg">
        <div class="parallax-content">
            <div class="container section-80 section-md-145">
                <div class="row justify-content-sm-center">
                    <div class="col-sm-9 col-md-7 col-lg-5 col-xl-4">
                        <!-- Box-->
                        <div class="box box-lg bg-default">
                            <svg x="0px" y="0px" width="88px" height="82px" viewbox="0 0 88 82">
                                <g>
                                    <path fill="#8CBCD6" d="M52.027,50H38H10l22-32l14.605,21.244L54,30l9.933,12.416C65.246,42.144,66.606,42,68,42                c4.509,0,8.655,1.51,12,4.027V8c0-4.4-3.6-8-8-8H8C3.6,0,0,3.6,0,8v52c0,4.4,3.6,8,8,8h40.918C48.323,66.106,48,64.091,48,62                C48,57.491,49.51,53.345,52.027,50z M62,12c3.314,0,6,2.686,6,6s-2.686,6-6,6s-6-2.686-6-6S58.686,12,62,12z"></path>
                                    <circle fill="#B3DDF5" cx="62" cy="18" r="6"></circle>
                                    <polygon fill="#9AC9E3" points="32,18 10,50 38,50 46.605,39.244 	"></polygon>
                                    <path fill="#B3DDF5" d="M46.605,39.244L38,50h14.027c2.871-3.816,7.059-6.583,11.906-7.584L54,30L46.605,39.244z"></path>
                                    <path fill="#F44336" d="M80,46.027C76.655,43.51,72.509,42,68,42c-1.394,0-2.754,0.144-4.067,0.416                c-4.846,1.001-9.034,3.769-11.906,7.584C49.51,53.345,48,57.491,48,62c0,2.091,0.323,4.106,0.918,6C51.467,76.114,59.045,82,68,82                c11.046,0,20-8.954,20-20C88,55.463,84.85,49.676,80,46.027z M74.379,72.21l-6.363-6.363l-6.379,6.379l-4.242-4.242l6.379-6.379                l-6.363-6.363L61.653,51l6.363,6.363l6.347-6.347l4.242,4.242l-6.347,6.347l6.363,6.363L74.379,72.21z"></path>
                                    <rect x="59.714" y="51.803" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -21.4435 60.8358)" fill="#FFFFFF" width="5.999" height="8.999"></rect>
                                    <rect x="70.319" y="62.408" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -25.8363 71.4408)" fill="#FFFFFF" width="5.999" height="8.999"></rect>
                                    <polygon fill="#FFFFFF" points="78.605,55.258 74.363,51.016 68.016,57.363 63.774,61.605 57.395,67.984 61.637,72.226                 68.016,65.847 72.258,61.605 	"></polygon>
                                </g>
                            </svg>
                            <h5 class="text-ubold">{{ __('errors.pagenotfound') }}</h5>
                            <p class="text-small">{{ __('errors.pagenotfound_text') }}</p>
                            <a class="button button-icon button-icon-left button-primary" href="/{{ App::getLocale() }}/">
                                <span class="icon icon-xxs mdi mdi-chevron-left"></span><span>{{ __('errors.backtohome') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection