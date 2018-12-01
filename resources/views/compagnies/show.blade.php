@extends('layouts.other', [
                            'title' => $compagny->raison_sociale.' - '.$compagny->ville,
                            'activeVoyageCss' => 'active'
                            ])

@section('content')
    <section class="section parallax-container bg-black section-height-mac context-dark" data-parallax-img="/storage/{{ $compagny->background_image }}">
        <div class="parallax-content">
            <div class="container">
                <div class="row justify-content-sm-center align-items-sm-center section-34 section-md-top-145 section-md-bottom-100 section-lg-top-100 section-cover">
                    <div class="col-12">
                        <img src="/storage/{{ $compagny->logo }}"><br>
                        <h1 class="d-none d-lg-inline-block shadow">{{ $compagny->raison_sociale }}</h1>
                        <h6 class="font-italic shadow">{{ $compagny->baseline }}</h6>
                        <a href="#" class="add-to-cart button button-primary" data-toggle="modal" data-content="" data-target="#modal-cart">
                            {{ __('voyage.acheter') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tour Single-->
    <section class="section-34 section-md-bottom-45 bg-alabaster">
        <div class="container">
            <div class="row justify-content-sm-center">
                <div class="col-sm-10 col-md-8 col-lg-12">
                    <div class="row row-40 justify-content-sm-center list-inline-dashed-vertival">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <p class="text-extra-small text-silver-chalice font-italic text-uppercase text-spacing-200">
                                {{ $compagny->adresse }}<br>
                                {{ $compagny->code_postal }} - {{ $compagny->ville }}<br>
                                {{ $compagny->telephone }} - {{ $compagny->email }}
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tour Program-->
    <section class="section-70 section-md-bottom-80 programme-voyage">
        <div class="container">
            <h3>Liste des voyages</h3>
                @include('voyages._voyages', ['allVoyages' => $compagny->voyages()->get()])
        </div>
    </section>

    <!-- Slider Images -->
    <section>
        <div class="owl-carousel owl-carusel-inset-bottom owl-nav-type-3 owl-dots-primary" data-lightgallery="group" data-items="1" data-md-items="2" data-lg-items="3" data-xl-items="5" data-stage-padding="20" data-loop="true" data-margin="6" data-mouse-drag="false" data-dots="true" data-nav="true">
            <!-- Thumbnail Rayen-->
                    <div class="owl-item">
                        <a class="thumbnail-rayen" data-lightgallery="item" href="/storage/voyages/min/">
                    <span class="figure">
                        <img class="img-responsive center-block" width="310" src="/storage/voyages/" alt="">
                        <span class="figcaption">
                            <span class="icon icon-xl fa fa-search-plus text-white"></span>
                        </span>
                    </span>
                        </a>
                    </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section parallax-container bg-black" data-parallax-img="/images/backgrounds/background-34-1920x900.jpg">
        <div class="parallax-content">
            <div class="container section-70 section-md-bottom-80">
                <h3 class="text-white">Testimonials 3</h3>
                <p class="text-white">Feel free to browse our most popular testimonials</p>
                <div class="owl-carousel owl-dots-white owl-navs-white owl-carusel-inset-left-right owl-dots-lg-reveal owl-navs-lg-veil" data-items="1" data-md-items="2" data-lg-items="3" data-stage-padding="5" data-loop="false" data-margin="60" data-mouse-drag="false" data-dots="true" data-nav="true">
                    <div class="owl-item">
                        <!-- Blockquote-->
                        <blockquote class="quote quote-boxed box box-xs bg-default text-left">
                            <div class="quote-boxed-img-wrap"><img class="rounded-circle img-responsive" src="/images/users/user-01-60x60.jpg" width="60" height="60" alt=""></div>
                            <div class="quote-boxed-body">
                                <p class="text-small text-ubold text-spacing-200 text-uppercase"><a class="text-black" href="testimonials.html">James Smith</a></p>
                                <p class="text-small text-silver-chalice font-italic">
                                    <q>“I’d like to send you a sincere "thank you" for all of your assistance during my recent trip to Colorado. It was invaluable!”</q>
                                </p>
                            </div>
                        </blockquote>
                    </div>
                    <div class="owl-item">
                        <!-- Blockquote-->
                        <blockquote class="quote quote-boxed box box-xs bg-default text-left">
                            <div class="quote-boxed-img-wrap"><img class="rounded-circle img-responsive" src="/images/users/user-02-60x60.jpg" width="60" height="60" alt=""></div>
                            <div class="quote-boxed-body">
                                <p class="text-small text-ubold text-spacing-200 text-uppercase"><a class="text-black" href="testimonials.html">Mary Anderson</a></p>
                                <p class="text-small text-silver-chalice font-italic">
                                    <q>“Leslie was an excellent Travel Agent for us and considered our unique needs as she planned our itinerary.”</q>
                                </p>
                            </div>
                        </blockquote>
                    </div>
                    <div class="owl-item">
                        <!-- Blockquote-->
                        <blockquote class="quote quote-boxed box box-xs bg-default text-left">
                            <div class="quote-boxed-img-wrap"><img class="rounded-circle img-responsive" src="/images/users/user-03-60x60.jpg" width="60" height="60" alt=""></div>
                            <div class="quote-boxed-body">
                                <p class="text-small text-ubold text-spacing-200 text-uppercase"><a class="text-black" href="testimonials.html">Will Johnson</a></p>
                                <p class="text-small text-silver-chalice font-italic">
                                    <q>“I would highly recommend Andy because everything on my month long trip to New Zealand went without a hitch.”</q>
                                </p>
                            </div>
                        </blockquote>
                    </div>
                    <div class="owl-item">
                        <!-- Blockquote-->
                        <blockquote class="quote quote-boxed box box-xs bg-default text-left">
                            <div class="quote-boxed-img-wrap"><img class="rounded-circle img-responsive" src="/images/users/user-01-60x60.jpg" width="60" height="60" alt=""></div>
                            <div class="quote-boxed-body">
                                <p class="text-small text-ubold text-spacing-200 text-uppercase"><a class="text-black" href="testimonials.html">James Smith</a></p>
                                <p class="text-small text-silver-chalice font-italic">
                                    <q>“I’d like to send you a sincere "thank you" for all of your assistance during my recent trip to Colorado. It was invaluable!”</q>
                                </p>
                            </div>
                        </blockquote>
                    </div>
                    <div class="owl-item">
                        <!-- Blockquote-->
                        <blockquote class="quote quote-boxed box box-xs bg-default text-left">
                            <div class="quote-boxed-img-wrap"><img class="rounded-circle img-responsive" src="/images/users/user-02-60x60.jpg" width="60" height="60" alt=""></div>
                            <div class="quote-boxed-body">
                                <p class="text-small text-ubold text-spacing-200 text-uppercase"><a class="text-black" href="testimonials.html">Mary Anderson</a></p>
                                <p class="text-small text-silver-chalice font-italic">
                                    <q>“Leslie was an excellent Travel Agent for us and considered our unique needs as she planned our itinerary.”</q>
                                </p>
                            </div>
                        </blockquote>
                    </div>
                    <div class="owl-item">
                        <!-- Blockquote-->
                        <blockquote class="quote quote-boxed box box-xs bg-default text-left">
                            <div class="quote-boxed-img-wrap"><img class="rounded-circle img-responsive" src="/images/users/user-03-60x60.jpg" width="60" height="60" alt=""></div>
                            <div class="quote-boxed-body">
                                <p class="text-small text-ubold text-spacing-200 text-uppercase"><a class="text-black" href="testimonials.html">Will Johnson</a></p>
                                <p class="text-small text-silver-chalice font-italic">
                                    <q>“I would highly recommend Andy because everything on my month long trip to New Zealand went without a hitch.”</q>
                                </p>
                            </div>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Prix et call to action -->
    <section class="section-top-50 section-bottom-80">
        <div class="container">
            <h3>{{ __('voyage.book.this.flight') }}</h3>
            <p class="text-small text-spacing-200 font-italic"></p>
            <a href="#" class="add-to-cart button button-primary" data-toggle="modal" data-content="" data-target="#modal-cart">
                {{ __('voyage.acheter') }}
            </a>
        </div>
    </section>

    @include('partials._modal-add-to-cart')
@endsection