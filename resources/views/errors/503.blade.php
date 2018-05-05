@extends('layouts.other', ['title' => 'Service indisponible'])

@section('content')
    <section class="section parallax-container bg-black" data-parallax-img="/images/backgrounds/background-16-1920x900.jpg">
        <div class="parallax-content">
            <div class="container section-80 section-md-145">
                <div class="row justify-content-sm-center">
                    <div class="col-sm-9 col-md-7 col-lg-5 col-xl-4">
                        <!-- Box-->
                        <div class="box box-lg bg-default">
                            <svg x="0px" y="0px" width="64px" height="80px" viewbox="0 0 32 40">
                                <polygon fill="#42A5F5" points="0,4 0,40 28,40 28,12 20,4 "></polygon>
                                <polygon fill="#90CAF9" points="4,0 4,36 32.001,36 32.001,7.999 24.001,0 "></polygon>
                                <polygon fill="#E1F5FE" points="30.5,9 23,9 23,1.5 "></polygon>
                                <g>
                                    <path fill="#1976D2" d="M19.3,27.8c0-0.2-0.1-1.5-1.5-1.5c-1.5,0-1.5,1.3-1.5,1.5c0,0.4,0.2,1.4,1.5,1.4S19.3,28.2,19.3,27.8z"></path>
                                    <path fill="#1976D2" d="M18.1,12.8c-4.5,0-4.8,3.5-4.8,4.2H16c0-0.4,0.1-2,2.1-2c1.8,0,2,1.4,2,2.1c0,2.8-3.6,2.5-3.6,7.2v0.1H19                c0-3.3,3.8-3.8,3.8-7.3C22.8,16.4,22.7,12.8,18.1,12.8z"></path>
                                </g>
                            </svg>
                            <h5 class="text-ubold">{{ __('errors.temporaryUnavailable') }}</h5>
                            <p class="text-small">{{ __('errors.temporaryUnavailableText') }}</p>
                            <a class="button button-icon button-icon-left button-primary" href="/{{ App::getLocale() }}/">
                                <span class="icon icon-xxs mdi mdi-chevron-left"></span><span>Back to homepage</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection