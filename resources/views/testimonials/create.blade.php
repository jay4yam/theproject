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
            <p class="testimonials-p">
                Choisissez votre avatar, ou uploadez le votre.<br>
                Et partagez votre jolie expérience avec le monde entier !</p>
            <div class="box testimonials">
                <form action="/{{App::getLocale()}}/post/testimonials" id="post_testimonials" enctype="multipart/form-data" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" id="genre" value="" name="genre">
                    <input type="hidden" id="userid" value="{{ Auth::id() }}" name="userid">
                    <div class="row">
                        <div class="col-xs-12 col-md-4 man_style">
                            <div class="quote-boxed-img-testi">
                                <img data-genre="male" class="avatar rounded-circle img-responsive" src="/images/users/user-01-60x60.jpg" width="60" height="60" alt="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4 own_style">
                            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                        </div>
                        <div class="col-xs-12 col-md-4 woman_style">
                            <div class="quote-boxed-img-testi">
                                <img data-genre="female" class="avatar rounded-circle img-responsive" src="/images/users/user-02-60x60.jpg" width="60" height="60" alt="">
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
                                <input type="hidden" value="{{$mainOrder->order_id}}" id="main_order_id" name="main_order_id">
                                <input type="hidden" value="{{$item->voyage->id}}" id="voyage_id" name="voyage_id">
                                <input type="text" required id="fullname" name="fullname" value="{{ $mainOrder->user->profile->fullName }} {{ strtoupper( substr($mainOrder->user->profile->firstName, 0, 1)) }}" class="form-control" placeholder="{{ $mainOrder->user->profile->fullName }} {{ strtoupper( substr($mainOrder->user->profile->firstName, 0, 1)) }}.">
                            </div>
                            <div class="form-group">
                                <textarea required class="form-control" id="testimonials" name="testimonials"></textarea>
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

@section('dedicated_js')
    <script type="text/javascript">
        $(document).ready(function () {

            var imgMale = $("[data-genre='male']");
            var imgFemale = $("[data-genre='female']");

            //1.clic sur le type d'avatar
            $('.avatar').on('click', function (e) {
                //évite la propagation de l'event
                e.preventDefault();

                //recup le div parent de l'image
                var div = $(this).parent();

                //recupère le type d'avatar (m or f)
                var genre = $(this).attr('data-genre');

                //recup l'input hidden du form
                var inputHiddenGenre = $('#genre');

                if(genre == 'male'){
                    //modifie la couleur de la bordure pour montrer le clic
                    div.css({"border":"4px solid #01b9ff"});
                    //rajoute la valeur à l'input hidden pour soumission du form
                    inputHiddenGenre.val("male");

                    //remet en blanc le contour de l'autre avatar
                    imgFemale.parent().css({"border":"4px solid #ffffff"});

                }else if(genre == 'female'){
                    //modifie la couleur de la bordure pour montrer le clic
                    div.css({"border":"4px solid #ff00cc"});
                    //rajoute la valeur à l'input hidden pour soumission du form
                    inputHiddenGenre.val("female");

                    //remet en blanc le contour de l'autre avatar
                    imgMale.parent().css({"border":"4px solid #ffffff"});
                }
            })
        });
    </script>
@endsection