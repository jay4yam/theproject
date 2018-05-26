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
                                            <a class="shadow-drop-lg" href="{{ url()->current() . '?' . http_build_query(['view' => 'list']) }}" id="show-list">
                                                <span class="icon icon-sm icon-square mdi mdi-format-list-bulleted"></span>
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a class="shadow-drop-lg" href="{{ url()->current() . '?' . http_build_query(['view' => 'grid']) }}" id="show-grid">
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
                    {{ $allVoyages->appends(request()->input())->links() }}
                    </div>
                    <!-- Classic Pagination-->
                </div>

                <!-- Aside -->
                @include('voyages._aside')
                <!-- fin Aside -->
            </div>
        </div>
    </section>
@endsection

@section('dedicated_js')
    <script>

        testParam();

        function urlParam(name){
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            if (results==null){
                return null;
            }
            else{
                return decodeURI(results[1]) || 0;
            }
        };

        function testParam() {
            if( urlParam('view') === 'list'){
                //affiche ou masque le div correspondant
                $('#grid-view').hide();
                $('#list-view').show();

                $('#show-grid').parent('li').removeClass('active');
                $('#show-list').parent('li').addClass('active');
            }

            if( urlParam('view') === 'grid'){
                //affiche ou masque le div correspondant
                $('#list-view').hide();
                $('#grid-view').show();

                $('#show-list').parent('li').removeClass('active');
                $('#show-grid').parent('li').addClass('active');
            }

        }

        testParam();
    </script>
@endsection