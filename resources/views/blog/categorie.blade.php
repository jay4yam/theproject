@extends('layouts.other', ['title' => 'Blog easyCopter | categorie | '. $categories->title])

@section('content')
    <section class="section parallax-container bg-black section-height-mac context-dark" data-parallax-img="/images/backgrounds/background-22-1920x900.jpg">
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
                                        <li><a class="shadow-drop-lg" href="blog-list.html"><span class="icon icon-sm icon-square mdi mdi-view-stream"></span></a></li>
                                        <li class="active"><a class="shadow-drop-lg" href="blog-list-variant-2.html"><span class="icon icon-sm icon-square mdi mdi-format-list-bulleted"></span></a></li>
                                        <li><a class="shadow-drop-lg" href="blog-grid.html"><span class="icon icon-sm icon-square mdi mdi-view-module"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-30 row-offset-1 justify-content-sm-center justify-content-md-between">
                        @foreach($categories->blogs as $article)
                            @include('partials._blog_article')
                        @endforeach
                    </div>
                </div>

                <!-- Debut Aside container -->
                @include('partials._blog_aside')
            </div>
        </div>
    </section>
@endsection