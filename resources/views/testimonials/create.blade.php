@extends('layouts.other', ['title' => 'Partager votre expérience | easyCopter'])

@section('content')
    <section class="section parallax-container bg-black section-height-mac context-dark" data-parallax-img="/images/backgrounds/friends.jpg">
        <div class="parallax-content">
            <div class="bg-overlay-darker">
                <div class="container section-34 section-md-100 section-lg-top-170 section-lg-bottom-165">
                    <h1 class="d-none d-lg-inline-block">{{ __('testimonials.title') }}</h1>
                    <h6 class="font-italic">{{ __('testimonials.subtitle') }}!</h6>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us V2-->
    <section class="section-80 bg-wild-wand">
        <div class="container">
            <div class="box testimonials">
                <form method="POST" action="/{{App::getLocale()}}/post/testimonials" id="post_testimonials" >
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-xs-12 col-md-4 man_style">
                            <div class="quote-boxed-img-testi">
                                <img class="rounded-circle img-responsive" src="/images/users/user-01-60x60.jpg" width="60" height="60" alt="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4 own_style">
                            <input type="file" class="form-control" id="avatar" accept="image/*">
                        </div>
                        <div class="col-xs-12 col-md-4 woman_style">
                            <div class="quote-boxed-img-testi">
                                <img class="rounded-circle img-responsive" src="/images/users/user-02-60x60.jpg" width="60" height="60" alt="">
                            </div>
                        </div>
                    </div>
                    @foreach($mainOrder->itemsOrder as $item)
                        <div class="row ptnb-10">
                        <div class="col-md-4 no-padding">
                            <div class="img-voyage-testi" style="background-image: url('/storage/voyages/{{ $item->voyage->main_photo }}')">
                                <h5>pour le vol {{ strtoupper($item->voyage->title) }}<br> effectué le<br> {{ $item->date_voyage->format('d M Y') }}</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-10 my-auto">
                            <div class="form-group">
                                <input type="hidden" value="{{$mainOrder->order_id}}" id="main_order_id[]" name="main_order_id[]">
                                <input type="hidden" value="{{$item->voyage->id}}" id="voyage_id[]" name="voyage_id[]">
                                <input type="text" id="full name[]" class="form-control" placeholder="{{ $mainOrder->user->profile->fullName }} {{ strtoupper( substr($mainOrder->user->profile->firstName, 0, 1)) }}.">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="testimonials[]" name="testimonials[]"></textarea>
                            </div>
                        </div>
                        <div class="col-2 my-auto">
                            <button class="button button-primary btn-without-width">
                                Envoyer
                            </button>
                        </div>
                        </div>
                    @endforeach
                </form>
            </div>
        </div>
    </section>
@endsection