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
                        <a href="#" class="add-to-cart button button-primary" data-toggle="modal" data-content="{{ $voyage->id }}" data-target="#modal-cart">
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
                            @foreach($voyage->compagnies as $compagnie)
                            <p class="text-big text-ubold text-black text-uppercase">
                                <a href="{{ route('compagnie.front.show', ['id' => $compagnie->id, 'companyName' => str_slug($compagnie->raison_sociale)]) }}">
                                    {{ $compagnie->raison_sociale }}
                                </a>
                            </p>
                            @endforeach
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
    <section class="section-70 section-md-bottom-80 programme-voyage">
        <div class="container">
            <h3>Tour Program</h3>
            <p>Here is what’s included in the program of this tour</p>
            <div class="intro">
                {!!  $voyage->intro  !!}
            </div>
            <div class="description">
                {!! $voyage->description !!}
            </div>
        </div>
    </section>

    <!-- Slider Images -->
    <section>
        <div class="owl-carousel owl-carusel-inset-bottom owl-nav-type-3 owl-dots-primary" data-lightgallery="group" data-items="1" data-md-items="2" data-lg-items="3" data-xl-items="5" data-stage-padding="20" data-loop="true" data-margin="6" data-mouse-drag="false" data-dots="true" data-nav="true">
            <!-- Thumbnail Rayen-->
            @if(is_dir('storage/voyages/'.$voyage->id.'/min'))
                @foreach(File::allFiles('storage/voyages/'.$voyage->id.'/min') as $file)
                <div class="owl-item">
                <a class="thumbnail-rayen" data-lightgallery="item" href="/storage/voyages/{{$voyage->id}}/min/{{ $file->getFilename() }}">
                    <span class="figure">
                        <img class="img-responsive center-block" width="310" src="/storage/voyages/{{$voyage->id}}/min/{{ $file->getFilename() }}" alt="">
                        <span class="figcaption">
                            <span class="icon icon-xl fa fa-search-plus text-white"></span>
                        </span>
                    </span>
                </a>
            </div>
                @endforeach
            @endif
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section parallax-container bg-black" data-parallax-img="/images/backgrounds/background-34-1920x900.jpg">
        <div class="parallax-content">
            <a name="testimonials" id="#testimonials"></a>
            <div class="container section-70 section-md-bottom-80">
                <h3 class="text-white">{{ __('voyage.temoignages') }}</h3>
                <p class="text-white">{{ __('voyage.slogan_temoignages') }}</p>
                <div class="owl-carousel owl-dots-white owl-navs-white owl-carusel-inset-left-right owl-dots-lg-reveal owl-navs-lg-veil" data-items="1" data-md-items="2" data-lg-items="3" data-stage-padding="5" data-loop="false" data-margin="60" data-mouse-drag="false" data-dots="true" data-nav="true">
                    @foreach($voyage->comments as $comment)
                        <div class="owl-item">
                        <!-- Blockquote-->
                        <blockquote class="quote quote-boxed box box-xs bg-default text-left">
                            <div class="quote-boxed-img-wrap">
                                <img class="rounded-circle img-responsive" src="/storage/{{ $comment->genre_avatar }}" width="60" height="60" alt="">
                            </div>
                            <div class="quote-boxed-body">
                                <p class="text-small text-ubold text-spacing-200 text-uppercase">
                                    <a class="text-black" href="testimonials.html" data-toggle="modal" data-target="#comment-{{ $comment->id }}">
                                        {{ $comment->user_name_for_comment }}
                                    </a>
                                </p>
                                <p class="text-small text-silver-chalice font-italic">
                                    <q>“{{ str_limit($comment->content, 100 ) }}“</q>
                                </p>
                            </div>
                        </blockquote>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Prix et call to action -->
    <section class="section-top-50 section-bottom-80">
        <div class="container">
            <h3>{{ __('voyage.book.this.flight') }}</h3>
            <p class="text-small text-spacing-200 font-italic">{{ number_format($voyage->price, 2, ',', ' ') }} €</p>
            <a href="#" class="add-to-cart button button-primary" data-toggle="modal" data-content="{{ $voyage->id }}" data-target="#modal-cart">
                {{ __('voyage.acheter') }}
            </a>
        </div>
    </section>

    <!-- Listes des autres voyages dans la même régions / pays -->
    <section class="section-34 section-lg-bottom-45 bg-alabaster">
        <div class="container">
            <!-- Owl Carousel-->
            <div class="owl-carousel owl-carousel-sm owl-navs-offset-0 owl-dots-primary owl-nav-alabaster list-inline-dashed-vertival" data-items="1" data-md-items="2" data-stage-padding="5" data-loop="false" data-margin="30" data-mouse-drag="false" data-dots="true" data-nav="true">
                @foreach($voyagesInRegion as $voy)
                <div class="owl-item">
                    <p class="text-extra-small text-silver-chalice font-italic text-uppercase text-spacing-200">
                        <a class="text-black" href="#">
                            {{ $voy->ville->name }}
                        </a>
                    </p>
                    <p class="text-big text-ubold text-uppercase">
                        <a href="{{ route('front.voyage.show', ['id' => $voy->id, 'slug' => str_slug($voy->title)]) }}">
                            {{ $voy->title }}
                        </a>
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials._modal-add-to-cart')

    <!-- Modal testimonials for testimonials details-->
    @include('partials._modal_testimonials', ['comments' => $voyage->comments])

@endsection

@section('dedicated_js')
    <script type="text/javascript">
        window.addEventListener("load", function(){
            if(location.hash === '#testimonials') {
            top.location.href = "#testimonials";
            }
        });
    </script>
@endsection