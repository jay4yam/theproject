@extends('layouts.other', [
                'title' => 'Vol en Hélicoptère, Baptême, Liste de nos voyages | easyCopter',
                'activeVoyageCss' => 'active'
                ])

@section('content')
    <section class="section parallax-container bg-black section-height-mac context-dark" data-parallax-img="/images/backgrounds/background-38-1920x900.jpg">
        <div class="parallax-content">
            <div class="bg-overlay-darker">
                <div class="container section-34 section-md-100 section-lg-top-170 section-lg-bottom-165">
                    <h1 class="d-none d-lg-inline-block">{{ __('voyage.h1') }}</h1>
                    <h6 class="font-italic">{{ __('voyage.h6') }}</h6>
                </div>
            </div>
        </div>
    </section>

    <!-- Tours Grid Variant 2-->
    <section class="section-80 section-md-bottom-70 bg-wild-wand">
        <div class="container">
            <div class="row row-50 justify-content-sm-center">
                <!-- Content -->
                <div class="col-md-11 col-lg-9 order-lg-1">
                    <div class="row row-20 justify-content-sm-between">
                        <div class="col-md-6 col-md-3 text-md-left">
                            <div class="d-inline-block inset-md-left-20 inset-lg-left-0">
                                <div class="pull-left inset-right-10">
                                    <p class="text-extra-small text-uppercase text-black">{{ __('voyage.sort_by') }}</p>
                                </div>
                                <div class="pull-right shadow-drop-xs d-inline-block select-xs">
                                    <!--Select 2-->
                                    <select class="form-input select-filter" data-minimum-results-for-search="Infinity" data-constraints="@Required">
                                        <option value="2">{{ __('voyage.popular') }}</option>
                                        <option value="3">{{ __('voyage.newest') }}</option>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-3 text-md-right">
                            <div class="d-inline-block inset-md-right-20 inset-lg-right-0">
                                <div class="pull-left inset-right-10">
                                    <p class="text-extra-small text-uppercase text-black">{{ __('voyage.vue') }}</p>
                                </div>
                                <div class="pull-right">
                                    <!-- List view type -->
                                    <ul class="list-inline list-primary-filled text-center list-top-panel">
                                        <li>
                                            <a class="shadow-drop-lg" href="#" id="show-list">
                                                <span class="icon icon-sm icon-square mdi mdi-format-list-bulleted"></span>
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a class="shadow-drop-lg" href="#" id="show-grid">
                                                <span class="icon icon-sm icon-square mdi mdi-view-module"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    @include('voyages._voyages')

                    <!-- Classic Pagination-->
                    <div class="paginate" align="center">
                    {{ $allVoyages->links() }}
                    </div>
                    <!-- Classic Pagination-->
                </div>

                <!-- Aside -->
                <div class="col-md-10 col-lg-3 text-lg-left">

                    <aside class="blog-aside box box-xs d-block bg-default">
                        <div class="blog-aside-item">
                            <p class="text-black text-ubold text-uppercase text-spacing-200">Search</p>
                            <!-- RD Search Form-->
                            <form class="rd-mailform">
                                <div class="form-blog-search">
                                    <button class="form-search-submit">
                                        <span>
                                            <img class="img-responsive center-block" src="/images/icons/icon-34-16x21.png" width="16" height="21" alt="">
                                        </span>
                                    </button>
                                    <div class="form-wrap form-wrap-xs">
                                        <label class="form-label form-search-label form-label-sm" for="tours-destination">Your Destination</label>
                                        <input class="form-search-input input-sm form-input" id="tours-destination" type="text">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr class="hr bg-gallery">
                        <div class="blog-aside-item box-range">
                            <p class="text-black text-ubold text-uppercase text-spacing-200">PRICE RANGE</p>
                            <!--RD Range-->
                            <div class="rd-range" data-min="{{ $minPrice }}" data-max="{{ $maxPrice }}" data-start="[{{ $minPrice }}, {{ $maxPrice }}]" data-step="1" data-tooltip="true" data-min-diff="30" data-input=".rd-range-input-value-1" data-input-2=".rd-range-input-value-2"></div>
                        </div>
                        <hr class="hr bg-gallery">
                        <div class="blog-aside-item">
                            <p class="text-black text-ubold text-uppercase text-spacing-200">Villes</p>
                            <!-- List-->
                            <ul class="list list-1 list-checkbox text-left">
                                @foreach($villes as $villeId => $VilleName)
                                <li>
                                    <label class="checkbox-inline checkbox-inline-left">
                                        <input class="checkbox-custom" name="remember" value="{{ $villeId }}" type="checkbox">
                                        <span class="text-small">{{ $VilleName }} (721)</span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                            <a class="button button-primary button-width-110" href="#">Search</a>
                        </div>
                    </aside>
                </div>
                <!-- fin Aside -->
            </div>
        </div>
    </section>
@endsection

@section('dedicated_js')
    <script>
        $(document).ready(function () {

            $('#show-list').on('click', function (e) {
                e.preventDefault();

                //aafiche ou masque le div correspondant
                $('#grid-view').fadeOut();
                $('#list-view').fadeIn();

                $('#show-grid').parent('li').removeClass('active');
                $(this).parent('li').addClass('active');
            });

            $('#show-grid').on('click', function (e) {
                e.preventDefault();

                //aafiche ou masque le div correspondant
                $('#grid-view').fadeIn();
                $('#list-view').fadeOut();

                $('#show-list').parent('li').removeClass('active');
                $(this).parent('li').addClass('active');
            });

        });
    </script>
@endsection