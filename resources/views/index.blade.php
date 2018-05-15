@extends('layouts.home', [
                            'title' => 'Vols en Hélicoptère en France et dans le monde',
                            'activeHomeCss' => 'active'])

@section('content')
    <!-- Swiper-->
    <section class="swiper-container swiper-slider" data-height="" data-min-height="400px" data-simulate-touch="false" data-slide-effect="fade">
        <div class="swiper-wrapper">
            <div class="swiper-slide" data-slide-bg="/images/backgrounds/background-01-1920x900.jpg"></div>
            <div class="swiper-slide" data-slide-bg="/images/backgrounds/background-02-1920x900.jpg"></div>
            <div class="swiper-slide" data-slide-bg="/images/backgrounds/background-03-1920x900.jpg"></div>
        </div>
        <div class="swiper-caption-absolute">
            <div class="container">
                <div class="row justify-content-sm-center">
                    <div class="col-xl-10">
                        <h1 class="text-white">Vivez une expérience unique</h1>
                        <p class="h6 text-white">Découvrez des paysages uniques d'un point de vue extraordinaire</p>
                        <!-- Form-->
                        <form class="rd-mailform form-inline-search">
                            <div class="form-wrap form-wrap-xs form-inline-item">
                                <label class="form-label" for="index-destination">Your Destination</label>
                                <input class="form-input" id="index-destination" type="text" name="destination">
                            </div>
                            <div class="form-wrap form-wrap-xs form-inline-item form-inline-item-xs">
                                <label class="form-label" for="index-arrival">Arrival</label>
                                <input class="form-input" id="index-arrival" type="text" name="destination">
                            </div>
                            <div class="form-wrap form-wrap-xs form-inline-item form-inline-item-xs">
                                <label class="form-label" for="index-departure">Departure</label>
                                <input class="form-input" id="index-departure" type="text" name="departure">
                            </div>
                            <div class="form-wrap form-wrap-xs form-inline-item">
                                <label class="form-label" for="index-budget">Your Budget ($)</label>
                                <input class="form-input" id="index-budget" type="text" name="budget">
                            </div>
                            <div class="form-inline-item button-wrap">
                                <button class="button button-primary" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Swiper Pagination-->
        <div class="swiper-pagination"></div>
        <!-- Swiper Navigation-->
        <div class="swiper-button-prev"><span class="icon icon-xxs icon-circle icon-filled-white mdi mdi-chevron-left text-gray"></span></div>
        <div class="swiper-button-next"><span class="icon icon-xxs icon-circle icon-filled-white mdi mdi-chevron-right text-gray"></span></div>
    </section>
    <!-- Best Offers-->
    <section class="section-80 section-md-top-70 bg-wild-wand">
        <div class="container">
            <h3>{{ __('home.h3circuits') }}</h3>
            <p>{{ __('home.pcircuits') }}</p>
            <div class="row row-30 justify-content-sm-center">
                <div class="col-md-5 col-lg-4">
                    <!-- Box Offer-->
                    <div class="box-offer wow fadeInLeft" data-wow-delay=".2s">
                        <div class="box-offer-img-wrap"><a href="tours-single.html"><img class="img-responsive center-block" src="/images/offers/box-offer-01-370x310.jpg" width="370" height="310" alt=""></a></div>
                        <div class="box-offer-caption text-left">
                            <div class="pull-left">
                                <div class="box-offer-title text-ubold"><a class="text-black" href="tours-single.html">Turkey</a></div>
                            </div>
                            <div class="pull-right">
                                <div class="box-offer-price text-black">$2,000</div>
                            </div>
                            <div class="clearfix"></div>
                            <!-- List Inline-->
                            <ul class="list-inline list-inline-13 list-inline-marked text-silver-chalice text-small">
                                <li>Istanbul, Antalya, Ephesus</li>
                                <li>8 days</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <!-- Box Offer-->
                    <div class="box-offer wow bounceIn" data-wow-delay=".2s">
                        <div class="box-offer-img-wrap"><a href="tours-single.html"><img class="img-responsive center-block" src="/images/offers/box-offer-02-370x310.jpg" width="370" height="310" alt=""></a></div>
                        <div class="box-offer-caption text-left">
                            <div class="pull-left">
                                <div class="box-offer-title text-ubold"><a class="text-black" href="tours-single.html">Spain</a></div>
                            </div>
                            <div class="pull-right">
                                <div class="box-offer-price text-black">$3,000</div>
                            </div>
                            <div class="clearfix"></div>
                            <!-- List Inline-->
                            <ul class="list-inline list-inline-13 list-inline-marked text-silver-chalice text-small">
                                <li>Madrid, Andalucia, Barcelona</li>
                                <li>9 days</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <!-- Box Offer-->
                    <div class="box-offer wow fadeInRight" data-wow-delay=".2s">
                        <div class="box-offer-img-wrap"><a href="tours-single.html"><img class="img-responsive center-block" src="/images/offers/box-offer-03-370x310.jpg" width="370" height="310" alt=""></a></div>
                        <div class="box-offer-caption text-left">
                            <div class="pull-left">
                                <div class="box-offer-title text-ubold"><a class="text-black" href="tours-single.html">United Kingdom</a></div>
                            </div>
                            <div class="pull-right">
                                <div class="box-offer-price text-black">$5,000</div>
                            </div>
                            <div class="clearfix"></div>
                            <!-- List Inline-->
                            <ul class="list-inline list-inline-13 list-inline-marked text-silver-chalice text-small">
                                <li>England, Scotland, Wales</li>
                                <li>13 days</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <!-- Box Offer-->
                    <div class="box-offer wow fadeInLeft" data-wow-delay=".2s">
                        <div class="box-offer-img-wrap"><a href="tours-single.html"><img class="img-responsive center-block" src="/images/offers/box-offer-04-370x310.jpg" width="370" height="310" alt=""></a></div>
                        <div class="box-offer-caption text-left">
                            <div class="pull-left">
                                <div class="box-offer-title text-ubold"><a class="text-black" href="tours-single.html">Eastern Europe</a></div>
                            </div>
                            <div class="pull-right">
                                <div class="box-offer-price text-black">$2,500</div>
                            </div>
                            <div class="clearfix"></div>
                            <!-- List Inline-->
                            <ul class="list-inline list-inline-13 list-inline-marked text-silver-chalice text-small">
                                <li>Slovenia, Hungary, Poland</li>
                                <li>10 days</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <!-- Box Offer-->
                    <div class="box-offer wow bounceIn" data-wow-delay=".2s">
                        <div class="box-offer-img-wrap"><a href="tours-single.html"><img class="img-responsive center-block" src="/images/offers/box-offer-05-370x310.jpg" width="370" height="310" alt=""></a></div>
                        <div class="box-offer-caption text-left">
                            <div class="pull-left">
                                <div class="box-offer-title text-ubold"><a class="text-black" href="tours-single.html">Italy</a></div>
                            </div>
                            <div class="pull-right">
                                <div class="box-offer-price text-black">$2,700</div>
                            </div>
                            <div class="clearfix"></div>
                            <!-- List Inline-->
                            <ul class="list-inline list-inline-13 list-inline-marked text-silver-chalice text-small">
                                <li>Rome, Milan, Venice</li>
                                <li>7 days</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <!-- Box Offer-->
                    <div class="box-offer wow fadeInRight" data-wow-delay=".2s">
                        <div class="box-offer-img-wrap"><a href="tours-single.html"><img class="img-responsive center-block" src="/images/offers/box-offer-06-370x310.jpg" width="370" height="310" alt=""></a></div>
                        <div class="box-offer-caption text-left">
                            <div class="pull-left">
                                <div class="box-offer-title text-ubold"><a class="text-black" href="tours-single.html">Swiss Alps</a></div>
                            </div>
                            <div class="pull-right">
                                <div class="box-offer-price text-black">$5,100</div>
                            </div>
                            <div class="clearfix"></div>
                            <!-- List Inline-->
                            <ul class="list-inline list-inline-13 list-inline-marked text-silver-chalice text-small">
                                <li>Zurich, Geneve, Luzern</li>
                                <li>13 days</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><a class="button button-primary" href="tours-grid.html">{{ __('home.actioncircuits') }}</a>
        </div>
    </section>
    <!-- Why SunTravel-->
    <section class="section parallax-container bg-black wow fadeIn" data-parallax-img="/images/backgrounds/background-05-1920x900.jpg" data-wow-delay=".2s">
        <div class="parallax-content">
            <div class="bg-overlay-inverse-md-darker">
                <div class="container section-80 section-md-top-70">
                    <h3 class="text-white">{{ __('home.h3superCopter') }}</h3>
                    <div class="row row-30 row-sm justify-content-sm-center justify-content-lg-start text-sm-left">
                        <div class="col-md-6 col-lg-4">
                            <!-- Box-->
                            <div class="box box-sm bg-default d-block">
                                <div class="unit flex-column flex-sm-row unit-spacing-sm">
                                    <div class="unit-left">
                                        <div class="icon-circle icon-circle-lg icon-filled-turquoise center-block">
                                            <img class="img-responsive center-block" src="/images/icons/icon-11-20x18.png" width="20" height="18" alt=""></div>
                                    </div>
                                    <div class="unit-body">
                                        <p class="text-small text-black text-uppercase text-ubold">{{ __('home.supercopter_correspondance') }}</p>
                                        <p class="text-small text-silver-chalice">{{ __('home.supercopter_correspondance_text') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <!-- Box-->
                            <div class="box box-sm bg-default d-block">
                                <div class="unit flex-column flex-sm-row unit-spacing-sm">
                                    <div class="unit-left">
                                        <div class="icon-circle icon-circle-lg icon-filled-turquoise center-block"><img class="img-responsive center-block" src="/images/icons/icon-06-14x21.png" width="14" height="21" alt=""></div>
                                    </div>
                                    <div class="unit-body">
                                        <p class="text-small text-black text-uppercase text-ubold">{{ __('home.supercopter_variete') }}</p>
                                        <p class="text-small text-silver-chalice">{{ __('home.supercopter_variete_text') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <!-- Box-->
                            <div class="box box-sm bg-default d-block">
                                <div class="unit flex-column flex-sm-row unit-spacing-sm">
                                    <div class="unit-left">
                                        <div class="icon-circle icon-circle-lg icon-filled-turquoise center-block"><img class="img-responsive center-block" src="/images/icons/icon-07-21x18.png" width="21" height="18" alt=""></div>
                                    </div>
                                    <div class="unit-body">
                                        <p class="text-small text-black text-uppercase text-ubold">{{ __('home.supercopter_quality') }}</p>
                                        <p class="text-small text-silver-chalice">{{ __('home.supercopter_quality_text') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <!-- Box-->
                            <div class="box box-sm bg-default d-block">
                                <div class="unit flex-column flex-sm-row unit-spacing-sm">
                                    <div class="unit-left">
                                        <div class="icon-circle icon-circle-lg icon-filled-turquoise center-block"><img class="img-responsive center-block" src="/images/icons/icon-08-17x19.png" width="17" height="19" alt=""></div>
                                    </div>
                                    <div class="unit-body">
                                        <p class="text-small text-black text-uppercase text-ubold">{{ __('home.supercopter_support') }}</p>
                                        <p class="text-small text-silver-chalice">{{ __('home.supercopter_support_text') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <!-- Box-->
                            <div class="box box-sm bg-default d-block">
                                <div class="unit flex-column flex-sm-row unit-spacing-sm">
                                    <div class="unit-left">
                                        <div class="icon-circle icon-circle-lg icon-filled-turquoise center-block"><img class="img-responsive center-block" src="/images/icons/icon-09-20x20.png" width="20" height="20" alt=""></div>
                                    </div>
                                    <div class="unit-body">
                                        <p class="text-small text-black text-uppercase text-ubold">{{ __('home.supercopter_partenaires') }}</p>
                                        <p class="text-small text-silver-chalice">{{ __('home.supercopter_partenaires_text') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <!-- Box-->
                            <div class="box box-sm bg-default d-block">
                                <div class="unit flex-column flex-sm-row unit-spacing-sm">
                                    <div class="unit-left">
                                        <div class="icon-circle icon-circle-lg icon-filled-turquoise center-block"><img class="img-responsive center-block" src="/images/icons/icon-10-25x24.png" width="25" height="24" alt=""></div>
                                    </div>
                                    <div class="unit-body">
                                        <p class="text-small text-black text-uppercase text-ubold">{{ __('home.supercopter_pricing') }}</p>
                                        <p class="text-small text-silver-chalice">{{ __('home.supercopter_pricing_text') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What Customers Say-->
    <section class="section-70 section-md-bottom-80 wow fadeIn" data-wow-delay=".2s">
        <div class="container">
            <h3>{{ __('home.h3AvisClients') }}</h3>
            <p>{{ __('home.pAvisClients') }}</p>
            <div class="row justify-content-sm-center">
                <div class="col-lg-10 col-xl-12">
                    <!-- Owl Carousel-->
                    <div class="owl-carousel owl-dots-primary" data-items="1" data-md-items="2" data-xl-items="3" data-stage-padding="5" data-loop="false" data-margin="30" data-mouse-drag="false" data-dots="true" data-nav="true">
                        <div class="owl-item">
                            <!-- Team Member-->
                            <div class="team-member">
                                <div class="team-member-img-wrap"><img class="rounded-circle img-responsive center-block" src="/images/users/user-01-100x100.jpg" width="100" height="100" alt=""></div>
                                <div class="team-member-body">
                                    <div class="team-member-title text-small text-ubold text-uppercase text-spacing-200 text-black">James smith</div>
                                    <p class="text-small font-italic text-silver-chalice">“I’d like to send you a sincere "thank you" for all of your assistance during my recent trip to Colorado.  It was invaluable to me and I realize and appreciate it greatly.”</p>
                                </div>
                                <div class="team-member-hover-content">
                                    <!-- Button trigger modal-->
                                    <button class="button button-primary" type="button" data-toggle="modal" data-target="#teamMember">{{ __('home.AvisClientsAction') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="owl-item">
                            <!-- Team Member-->
                            <div class="team-member">
                                <div class="team-member-img-wrap"><img class="rounded-circle img-responsive center-block" src="/images/users/user-02-100x100.jpg" width="100" height="100" alt=""></div>
                                <div class="team-member-body">
                                    <div class="team-member-title text-small text-ubold text-uppercase text-spacing-200 text-black">Mary Anderson</div>
                                    <p class="text-small font-italic text-silver-chalice">“Leslie was an excellent Travel Agent for us and considered our unique needs as she planned our itinerary. Every suggestion she made was excellent.”</p>
                                </div>
                                <div class="team-member-hover-content">
                                    <!-- Button trigger modal-->
                                    <button class="button button-primary" type="button" data-toggle="modal" data-target="#teamMember">{{ __('home.AvisClientsAction') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="owl-item">
                            <!-- Team Member-->
                            <div class="team-member">
                                <div class="team-member-img-wrap"><img class="rounded-circle img-responsive center-block" src="/images/users/user-03-100x100.jpg" width="100" height="100" alt=""></div>
                                <div class="team-member-body">
                                    <div class="team-member-title text-small text-ubold text-uppercase text-spacing-200 text-black">Will Johnson</div>
                                    <p class="text-small font-italic text-silver-chalice">“I would highly recommend Andy because everything on my month long trip to New Zealand, Australia and French Polynesia went without a hitch.”</p>
                                </div>
                                <div class="team-member-hover-content">
                                    <!-- Button trigger modal-->
                                    <button class="button button-primary" type="button" data-toggle="modal" data-target="#teamMember">{{ __('home.AvisClientsAction') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="owl-item">
                            <!-- Team Member-->
                            <div class="team-member">
                                <div class="team-member-img-wrap"><img class="rounded-circle img-responsive center-block" src="/images/users/user-01-100x100.jpg" width="100" height="100" alt=""></div>
                                <div class="team-member-body">
                                    <div class="team-member-title text-small text-ubold text-uppercase text-spacing-200 text-black">James smith</div>
                                    <p class="text-small font-italic text-silver-chalice">“I’d like to send you a sincere "thank you" for all of your assistance during my recent trip to Colorado.  It was invaluable to me and I realize and appreciate it greatly.”</p>
                                </div>
                                <div class="team-member-hover-content">
                                    <!-- Button trigger modal-->
                                    <button class="button button-primary" type="button" data-toggle="modal" data-target="#teamMember">{{ __('home.AvisClientsAction') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><a class="button button-primary" href="testimonials.html">{{ __('home.AvisClientActionFinal') }}</a>
        </div>
    </section>

    <!-- Find Travel Perfection With the Professionalism of Experts-->
    <section class="section parallax-container bg-black context-dark wow fadeIn" data-parallax-img="/images/backgrounds/background-06-1920x900.jpg" data-wow-delay=".2s">
        <div class="parallax-content">
            <div class="bg-overlay-inverse-md-darker">
                <div class="container section-80 section-lg-top-145 section-lg-bottom-295">
                    <div class="row justify-content-sm-center justify-content-lg-end text-lg-right">
                        <div class="col-md-10 col-lg-7">
                            <h2>{{ __('home.h2experts') }}</h2><a class="button button-primary" href="tours-grid.html">{{ __('home.expertsAction') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Skills-->
    <section class="section-80 section-md-bottom-70">
        <div class="container">
            <div class="row justify-content-sm-center">
                <div class="col-sm-10 col-md-8 col-lg-12">
                    <div class="row row-60 justify-content-sm-center align-items-sm-center">
                        <div class="col-sm-6 col-lg-3 wow bounceIn" data-wow-delay=".6s">
                            <!-- CountTo-->
                            <svg x="0px" y="0px" width="48px" height="60px" viewbox="0 0 32 40">
                                <polygon fill="#FF9800" points="16,33 11,27 11,21 21,21 21,27 "></polygon>
                                <g>
                                    <path fill="#FFA726" d="M25,14.15V16c0,0.337-0.021,0.668-0.057,0.994C24.963,16.995,24.981,17,25,17c1.105,0,2-0.895,2-2                c0-0.739-0.405-1.377-1-1.723V13.3L25,14.15z"></path>
                                    <path fill="#FFA726" d="M7,14.15L6,13.3v-0.023C5.405,13.623,5,14.261,5,15c0,1.105,0.895,2,2,2c0.019,0,0.037-0.005,0.057-0.006                C7.021,16.668,7,16.337,7,16V14.15z"></path>
                                    <path fill="#FFB74D" d="M25,14.15L24,15v-5l-4-4L8,10v5l-1-0.85V16c0,0.337,0.021,0.668,0.057,0.994C7.546,21.519,11.337,25,16,25                s8.454-3.481,8.943-8.006C24.979,16.668,25,16.337,25,16V14.15z M12,16c-0.552,0-1-0.448-1-1s0.448-1,1-1s1,0.448,1,1                S12.552,16,12,16z M20,16c-0.552,0-1-0.448-1-1s0.448-1,1-1s1,0.448,1,1S20.552,16,20,16z"></path>
                                    <path fill="#FF5722" d="M6,11v2.277V13.3l1,0.85L8,15v-5l12-4l4,4v5l1-0.85l1-0.85v-0.023V11c0-4-1-8-6-9l-1-2h-3C9.9,0,6,4.9,6,11                z"></path>
                                    <circle fill="#784719" cx="20" cy="15" r="1"></circle>
                                    <circle fill="#784719" cx="12" cy="15" r="1"></circle>
                                    <path fill="#CFD8DC" d="M14,30l2-2l-5-1c0,0-11,2-11,13h14l1-9L14,30z"></path>
                                    <path fill="#CFD8DC" d="M21,27l-5,1l2,2l-1,1l1,9h14C32,29,21,27,21,27z"></path>
                                    <polygon fill="#3F51B5" points="18,30 16,28 14,30 15,31 14,40 18,40 17,31 	"></polygon>
                                </g>
                            </svg>
                            <div class="counter h3 text-ubold text-black">624</div>
                            <p class="font-italic">{{ __('home.happyclients') }}</p>
                        </div>
                        <div class="col-sm-6 col-lg-3 wow bounceIn" data-wow-delay=".2s">
                            <!-- CountTo-->
                            <svg x="0px" y="0px" width="72px" height="54px" viewbox="0 0 48 35.7">
                                <polygon fill="#673AB7" points="0,35.7 33,35.7 16.5,11.7 "></polygon>
                                <polygon fill="#9575CD" points="19.2,35.7 48,35.7 33.6,17.7 "></polygon>
                                <path fill="#40C4FF" d="M42.9,0C43.6,1.1,44,2.3,44,3.7c0,3.9-3.1,7-7,7c-0.7,0-1.3-0.1-1.9-0.3c1.2,2,3.4,3.3,5.9,3.3              c3.9,0,7-3.1,7-7C48,3.5,45.9,0.8,42.9,0z"></path>
                            </svg>
                            <div class="counter h3 text-ubold text-black">112</div>
                            <p class="font-italic">{{ __('home.amazing') }}</p>
                        </div>
                        <div class="col-sm-6 col-lg-3 wow bounceIn" data-wow-delay=".4s">
                            <!-- CountTo-->
                            <svg x="0px" y="0px" width="60px" height="56px" viewbox="0 0 40 37">
                                <g>
                                    <path fill="none" d="M23,2h-6c-0.6,0-1,0.4-1,1v1h8V3C24,2.4,23.6,2,23,2z"></path>
                                    <path fill="#263238" d="M5,37h2c0.6,0,1-0.4,1-1H4C4,36.6,4.4,37,5,37z"></path>
                                    <path fill="#263238" d="M33,37h2c0.6,0,1-0.4,1-1h-4C32,36.6,32.4,37,33,37z"></path>
                                    <path fill="#37474F" d="M16,3c0-0.6,0.4-1,1-1h6c0.6,0,1,0.4,1,1v1h2V3c0-1.7-1.3-3-3-3h-6c-1.7,0-3,1.3-3,3v1h2V3z"></path>
                                    <path fill="#78909C" d="M36,4H26h-2h-8h-2H4C1.8,4,0,5.8,0,8v24c0,2.2,1.8,4,4,4h4h24h4c2.2,0,4-1.8,4-4V8C40,5.8,38.2,4,36,4z"></path>
                                </g>
                            </svg>
                            <div class="counter h3 text-ubold text-black">59</div>
                            <p class="font-italic">{{ __('home.partenaires') }}</p>
                        </div>
                        <div class="col-sm-6 col-lg-3 wow bounceIn" data-wow-delay=".8s">
                            <!-- CountTo-->
                            <svg x="0px" y="0px" width="60px" height="56px" viewbox="0 0 40 37">
                                <g>
                                    <polygon fill="#558B2F" points="24.2,24.2 23.189,21 22.795,21 21.7,24.2 	"></polygon>
                                    <path fill="#558B2F" d="M36,14h-3v3c0,2.2-1.8,4-4,4h-3.953l2.553,6.9h-2.2l-0.6-2.1h-3.6l-0.7,2.1h-2.2l2.553-6.9H7v8                c0,2.2,1.8,4,4,4h25l4,4V18C40,15.8,38.2,14,36,14z"></path>
                                    <polygon fill="#1B5E20" points="24.2,24.2 21.7,24.2 22.795,21 20.853,21 18.3,27.9 20.5,27.9 21.2,25.8 24.8,25.8 25.4,27.9                 27.6,27.9 25.047,21 23.189,21 	"></polygon>
                                    <path fill="#8BC34A" d="M15.4,12.6c0.2,0.3,0.4,0.5,0.7,0.6c0.3,0.1,0.6,0.2,0.9,0.2c0.7,0,1.3-0.3,1.6-0.8                c0.4-0.6,0.6-1.4,0.6-2.5V9.7c0-1.1-0.2-1.9-0.6-2.4c-0.4-0.6-0.9-0.8-1.6-0.8s-1.3,0.3-1.6,0.8c-0.4,0.6-0.6,1.4-0.6,2.4v0.5                c0,0.5,0.1,1,0.2,1.4C15.1,12,15.2,12.4,15.4,12.6z"></path>
                                    <path fill="#8BC34A" d="M22.795,21h0.395h1.858H29c2.2,0,4-1.8,4-4v-3V4c0-2.2-1.8-4-4-4H4C1.8,0,0,1.8,0,4v21l4-4h3h13.853H22.795                z M17.8,15.2c-0.2,0-0.5,0.1-0.8,0.1c-0.6,0-1.2-0.1-1.8-0.3c-0.5-0.2-1-0.6-1.4-1c-0.4-0.4-0.7-1-0.9-1.6                c-0.2-0.6-0.3-1.3-0.3-2.1V9.9c0-0.8,0.1-1.5,0.3-2.1c0.2-0.6,0.5-1.2,0.9-1.6c0.4-0.4,0.8-0.8,1.4-1C15.7,5,16.3,4.9,17,4.9                c0.6,0,1.2,0.1,1.8,0.3c0.5,0.2,1,0.6,1.4,1c0.4,0.4,0.7,1,0.9,1.6c0.2,0.6,0.3,1.3,0.3,2.1v0.3c0,1-0.2,1.8-0.5,2.5                c-0.3,0.7-0.7,1.3-1.3,1.7l1.7,1.3L20,16.9L17.8,15.2z"></path>
                                    <path fill="#FFFFFF" d="M19.6,14.4c0.6-0.4,1-1,1.3-1.7c0.3-0.7,0.5-1.5,0.5-2.5V9.9c0-0.8-0.1-1.5-0.3-2.1                c-0.2-0.6-0.5-1.2-0.9-1.6c-0.4-0.4-0.9-0.8-1.4-1C18.2,5,17.6,4.9,17,4.9c-0.7,0-1.3,0.1-1.8,0.3c-0.6,0.2-1,0.6-1.4,1                c-0.4,0.4-0.7,1-0.9,1.6c-0.2,0.6-0.3,1.3-0.3,2.1v0.4c0,0.8,0.1,1.5,0.3,2.1c0.2,0.6,0.5,1.2,0.9,1.6c0.4,0.4,0.9,0.8,1.4,1                c0.6,0.2,1.2,0.3,1.8,0.3c0.3,0,0.6-0.1,0.8-0.1l2.2,1.7l1.3-1.2L19.6,14.4z M14.8,9.7c0-1,0.2-1.8,0.6-2.4                c0.3-0.5,0.9-0.8,1.6-0.8s1.2,0.2,1.6,0.8c0.4,0.5,0.6,1.3,0.6,2.4v0.4c0,1.1-0.2,1.9-0.6,2.5c-0.3,0.5-0.9,0.8-1.6,0.8                c-0.3,0-0.6-0.1-0.9-0.2c-0.3-0.1-0.5-0.3-0.7-0.6c-0.2-0.2-0.3-0.6-0.4-1c-0.1-0.4-0.2-0.9-0.2-1.4V9.7z"></path>
                                </g>
                            </svg>
                            <div class="counter h3 text-ubold text-black">299</div>
                            <p class="font-italic">{{ __('home.quotes') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fastest Way to Compare and Book over 450 Cheap Flights-->
    <section class="section parallax-container bg-black context-dark wow fadeIn" data-parallax-img="/images/backgrounds/background-07-1920x900.jpg" data-wow-delay=".2s">
        <div class="parallax-content">
            <div class="bg-overlay-inverse-md-darker">
                <div class="container section-80 section-lg-top-145 section-lg-bottom-295">
                    <div class="row justify-content-sm-center justify-content-lg-start text-lg-left">
                        <div class="col-md-10 col-lg-7">
                            <h2>{{ __('home.h2Fastest') }}</h2>
                            <a class="button button-primary" href="tours-grid.html">{{ __('home.fastestAction') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
