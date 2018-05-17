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
                                    <select class="form-input select-filter form-control-has-validation form-control-last-child select2-hidden-accessible" data-minimum-results-for-search="Infinity" data-constraints="@Required" id="regula-generated-764271" tabindex="-1" aria-hidden="true">
                                        <option value="2">Popularity</option>
                                        <option value="3">Newest</option>
                                    </select><span class="select2 select2-container select2-container--bootstrap select2-container--focus" dir="ltr" style="width: 120px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-regula-generated-764271-container"><span class="select2-selection__rendered" id="select2-regula-generated-764271-container" title="Popularity">Popularity</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span><span class="form-validation"></span>
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
                                    <!-- Format d'affichage de la page et des articles -->
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

                <!-- debut Aside Blog -->
                <div class="col-md-11 col-lg-3 text-lg-left">
                    <!-- Aside-->
                    <aside class="blog-aside box box-xs d-block bg-default">
                        <div class="blog-aside-item">
                            <p class="text-black text-ubold text-uppercase text-spacing-200">{{ __('blog.blog_search') }}</p>
                            <!-- RD Search Form-->
                            {{ Form::open(['route' => ['blog.search', App::getLocale()], 'method' => 'get','class' => 'form-blog-search form-blog-search-type-2 form-search rd-search']) }}
                            <button class="form-search-submit" type="submit"><span class="fa fa-search"></span></button>
                            <div class="form-wrap form-wrap-xs">
                                <label class="form-label form-search-label form-label-sm" for="blog-sidebar-form-search-widget">{{ __('blog.blog_request') }}</label>
                                <input class="form-search-input input-sm form-input input-sm" id="blog-sidebar-form-search-widget" type="text" name="q" autocomplete="off">
                            </div>
                            {{ Form::close() }}
                        </div>
                        <hr class="hr bg-gallery">
                        <div class="blog-aside-item">
                            <p class="text-black text-ubold text-uppercase text-spacing-200">Categories</p>
                            <!-- List-->
                            <ul class="list list-1 list-modern">
                                @include('partials._categories_name')
                            </ul>
                            <hr class="hr bg-gallery">
                            <div class="blog-aside-item">
                                <p class="text-black text-ubold text-uppercase text-spacing-200">Tags</p>
                                <div class="group group-xs button-tags text-left">
                                    @foreach(\App\Models\Tag::all() as $tag)
                                        <a class="button button-sm button-gray" href="{{ route('blog.tag', ['id' => $tag->id, 'locale' => App::getLocale()]) }}">{{ @$tag->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
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