@extends('layouts.other', ['title' => 'Blog easyCopter | On va vous donner envie de voler avec nous'])

@section('content')
    <section class="section parallax-container bg-black section-height-mac context-dark" data-parallax-img="/images/backgrounds/background-10-1920x900.jpg">
        <div class="parallax-content">
            <div class="bg-overlay-darker">
                <div class="container section-34 section-md-100 section-lg-top-170 section-lg-bottom-165">
                    <h1 class="d-none d-lg-inline-block">{{ __('blog.blog_main_title') }}</h1>
                    <h6 class="font-italic">{{ __('blog.blog_sub_title') }}</h6>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Blog-->
    <section class="section-80 bg-wild-wand">
        <div class="container">
            <div class="row row-50 justify-content-sm-center">
                <!-- Debut Blog articles container -->
                <div class="col-md-11 col-lg-9 order-lg-1">
                    <div class="row row-20 justify-content-sm-between">
                        <div class="col-md-6 col-md-3 text-md-left">
                            <div class="d-inline-block inset-md-left-20 inset-lg-left-0">
                                <div class="pull-left inset-right-10">
                                    <p class="text-extra-small text-uppercase text-black">{{ __('blog.blog_sort_by') }}</p>
                                </div>
                                <div class="pull-right shadow-drop-xs d-inline-block select-xs">
                                    <!--Select 2-->
                                    <select class="form-input select-filter" data-minimum-results-for-search="Infinity" data-constraints="@Required">
                                        <option value="2">{{ __('blog.blog_newest') }}</option>
                                        <option value="3">{{ __('blog.blog_eldest') }}</option>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-3 text-md-right">
                            <div class="d-inline-block inset-md-right-20 inset-lg-right-0">
                                <div class="pull-left inset-right-10">
                                    <p class="text-extra-small text-uppercase text-black">{{ __('blog.blog_vue') }}</p>
                                </div>
                                <div class="pull-right">
                                    <!-- List Inline-->
                                    <ul class="list-inline list-primary-filled text-center list-top-panel">
                                        <li>
                                            <a class="shadow-drop-lg" href="#" id="show-big-list">
                                                <span class="icon icon-sm icon-square mdi mdi-view-stream"></span>
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a class="shadow-drop-lg" href="#" id="show-list">
                                                <span class="icon icon-sm icon-square mdi mdi-format-list-bulleted"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="shadow-drop-lg" href="#" id="show-grid">
                                                <span class="icon icon-sm icon-square mdi mdi-view-module"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- INCLUDE DE LA VUE PARTIELLE DES ARTICLES --}}
                    @include('partials._blog_article')

                    <!-- Classic Pagination-->
                    <div class="paginate" align="center">
                        {{ $allArticles->links() }}
                    </div>
                </div>

                <!-- Debut Aside container -->
                @include('partials._blog_aside')
            </div>
        </div>
    </section>
@endsection

@section('dedicated_js')
    <script>
        $(document).ready(function () {
            // click sur le bouton show grid
            $('#show-grid').on('click', function (e) {
                e.preventDefault();
                //On affiche les articles contenant la class 'grid-a-view'
                $('.grid-a-view').fadeIn();
                //On masque les deux autres types d'articles
                $('.big-list-view').fadeOut();
                $('.list-a-view').fadeOut();

                //On supprime la class 'active' des 2 autres boutons
                $('#show-list').parent('li').removeClass('active');
                $('#show-big-list').parent('li').removeClass('active');
                //On ajoute la class 'active' sur le bouton
                $('#show-grid').parent('li').addClass('active');
            });

            // click sur le bouton show big-list
            $('#show-big-list').on('click', function (e) {
                e.preventDefault();
                //On affiche les articles contenant la class 'big-list-view'
                $('.big-list-view').fadeIn();
                //On masque les deux autres types d'articles
                $('.grid-a-view').fadeOut();
                $('.list-a-view').fadeOut();

                //On supprime la class 'active' des 2 autres boutons
                $('#show-list').parent('li').removeClass('active');
                $('#show-grid').parent('li').removeClass('active');
                //On ajoute la class 'active' sur le bouton
                $('#show-big-list').parent('li').addClass('active');
            });

            // click sur le bouton show list
            $('#show-list').on('click', function (e) {
                e.preventDefault();
                //On affiche les articles contenant la class 'list-a-view'
                $('.list-a-view').fadeIn();
                //On masque les deux autres types d'articles
                $('.big-list-view').fadeOut();
                $('.grid-a-view').fadeOut();

                //On supprime la class 'active' des 2 autres boutons
                $('#show-big-list').parent('li').removeClass('active');
                $('#show-grid').parent('li').removeClass('active');
                //On ajoute la class 'active' sur le bouton
                $('#show-list').parent('li').addClass('active');
            });
        });
    </script>
@endsection