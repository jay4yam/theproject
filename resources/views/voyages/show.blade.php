@extends('layouts.other', [
                            'title' => $voyage->title,
                            'activeVoyageCss' => 'active'
                            ])

@section('content')
    <section class="section parallax-container bg-black section-height-mac context-dark" data-parallax-img="/storage/voyages/{{ $voyage->main_photo }}">
        <div class="parallax-content">
            <div class="container">
                <div class="row justify-content-sm-center align-items-sm-center section-34 section-md-top-145 section-md-bottom-100 section-lg-top-100 section-cover">
                    <div class="col-12">
                        <h1 class="d-none d-lg-inline-block shadow">{{ $voyage->title }}</h1>
                        <h6 class="font-italic shadow">{{ $voyage->subtitle }}</h6>
                        <a class="button button-primary" href="pricing.html">
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
                        <div class="col-sm-6 col-md-5 col-lg-3">
                            <p class="text-extra-small text-silver-chalice font-italic text-uppercase text-spacing-200">{{ __('voyage.compagnie') }}</p>
                            <p class="text-big text-ubold text-black text-uppercase">//TODO afficher la compagnie</p>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-3">
                            <p class="text-extra-small text-silver-chalice font-italic text-uppercase text-spacing-200">{{ __('voyage.duration') }}</p>
                            <p class="text-big text-ubold text-black text-uppercase">{{ $voyage->duree_du_vol }} .min</p>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-3">
                            <p class="text-extra-small text-silver-chalice font-italic text-uppercase text-spacing-200">{{ __('voyage.price') }}</p>
                            <p class="text-big text-ubold text-black text-uppercase">{{ number_format($voyage->price, 2, ',', ' ') }} €</p>
                        </div>
                        <div class="col-sm-6 col-md-5 col-lg-3">
                            <p class="text-extra-small text-silver-chalice font-italic text-uppercase text-spacing-200">{{ __('voyage.location') }}</p>
                            <p class="text-big text-ubold text-black text-uppercase">{{ $voyage->region()->first()->name }} - {{ $voyage->ville->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tour Program-->
    <section class="section-70 section-md-bottom-80">
        <div class="container">
            <h3>Tour Program</h3>
            <p>Here is what’s included in the program of this tour</p>
            <!-- Owl Carousel-->
            <div class="owl-carousel owl-dots-primary owl-dots-lg-reveal owl-navs-lg-veil text-left" data-items="1" data-md-items="2" data-lg-items="3" data-stage-padding="5" data-loop="false" data-margin="30" data-mouse-drag="false" data-dots="true" data-nav="true">
                <div class="owl-item">
                    <div class="box-program">
                        <!-- Unit-->
                        <div class="unit flex-row unit-spacing-sm">
                            <div class="unit-left text-center">
                                <h3 class="text-ubold text-primary line-height-1">1-3</h3>
                                <p class="text-extra-small text-spacing-1000 text-black text-uppercase line-height-1 inset-left-10">day</p>
                            </div>
                            <div class="unit-body">
                                <p class="text-small text-ubold text-uppercase text-black">Berlin, Warsaw, krakow</p>
                            </div>
                        </div>
                        <div class="box-program-content inset-left-10 inset-right-10">
                            <hr class="hr bg-gallery">
                            <p class="text-small text-silver-chalice">Start your Eastern Europe trip from Berlin - one of the most attractive European cities. Head out to Warsaw - the capital of Poland, where you’ll be able to take a guided tour through the city’s places of interests and museums.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Slider Images -->
    <section>
        <div class="owl-carousel owl-carusel-inset-bottom owl-nav-type-3 owl-dots-primary" data-lightgallery="group" data-items="1" data-md-items="2" data-lg-items="3" data-xl-items="5" data-stage-padding="20" data-loop="true" data-margin="6" data-mouse-drag="false" data-dots="true" data-nav="true">
            <div class="owl-item">
                <!-- Thumbnail Rayen--><a class="thumbnail-rayen" data-lightgallery="item" href="/images/gallery/portfolio-04-1170x700_original.jpg"><span class="figure"><img class="img-responsive center-block" width="370" height="310" src="/images/offers/box-offer-01-370x310.jpg" alt=""><span class="figcaption"><span class="icon icon-xl fa fa-search-plus text-white"></span></span></span></a>
            </div>
            <div class="owl-item">
                <!-- Thumbnail Rayen--><a class="thumbnail-rayen" data-lightgallery="item" href="/images/gallery/portfolio-05-1170x700_original.jpg"><span class="figure"><img class="img-responsive center-block" width="370" height="310" src="/images/offers/box-offer-02-370x310.jpg" alt=""><span class="figcaption"><span class="icon icon-xl fa fa-search-plus text-white"></span></span></span></a>
            </div>
            <div class="owl-item">
                <!-- Thumbnail Rayen--><a class="thumbnail-rayen" data-lightgallery="item" href="/images/gallery/portfolio-06-1170x700_original.jpg"><span class="figure"><img class="img-responsive center-block" width="370" height="310" src="/images/offers/box-offer-03-370x310.jpg" alt=""><span class="figcaption"><span class="icon icon-xl fa fa-search-plus text-white"></span></span></span></a>
            </div>
            <div class="owl-item">
                <!-- Thumbnail Rayen--><a class="thumbnail-rayen" data-lightgallery="item" href="/images/gallery/portfolio-07-1170x700_original.jpg"><span class="figure"><img class="img-responsive center-block" width="370" height="310" src="/images/offers/box-offer-04-370x310.jpg" alt=""><span class="figcaption"><span class="icon icon-xl fa fa-search-plus text-white"></span></span></span></a>
            </div>
            <div class="owl-item">
                <!-- Thumbnail Rayen--><a class="thumbnail-rayen" data-lightgallery="item" href="/images/gallery/portfolio-08-1170x700_original.jpg"><span class="figure"><img class="img-responsive center-block" width="370" height="310" src="/images/offers/box-offer-05-370x310.jpg" alt=""><span class="figcaption"><span class="icon icon-xl fa fa-search-plus text-white"></span></span></span></a>
            </div>
            <div class="owl-item">
                <!-- Thumbnail Rayen--><a class="thumbnail-rayen" data-lightgallery="item" href="/images/gallery/portfolio-09-1170x700_original.jpg"><span class="figure"><img class="img-responsive center-block" width="370" height="310" src="/images/offers/box-offer-06-370x310.jpg" alt=""><span class="figcaption"><span class="icon icon-xl fa fa-search-plus text-white"></span></span></span></a>
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
            <p class="text-small text-spacing-200 font-italic">{{ number_format($voyage->price, 2, ',', ' ') }} €</p>
            <a class="button button-primary" href="pricing.html">{{ __('voyage.acheter') }}</a>
        </div>
    </section>

    <!-- Listes des autres voyages dans la même régions / pays -->
    <section class="section-34 section-lg-bottom-45 bg-alabaster">
        <div class="container">
            <!-- Owl Carousel-->
            <div class="owl-carousel owl-carousel-sm owl-navs-offset-0 owl-dots-primary owl-nav-alabaster list-inline-dashed-vertival" data-items="1" data-md-items="2" data-stage-padding="5" data-loop="false" data-margin="30" data-mouse-drag="false" data-dots="true" data-nav="true">
                @foreach($voyagesInRegion as $voy)
                <div class="owl-item">
                    <p class="text-extra-small text-silver-chalice font-italic text-uppercase text-spacing-200">{{ $voy->title }}</p>
                    <p class="text-big text-ubold text-uppercase">
                        <a class="text-black" href="tours-single.html">
                            {{ $voy->ville->name }}
                        </a>
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection