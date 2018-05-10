@extends('layouts.other', ['title' => ' On va vous donner envie de voler avec nous | Blog easyCopter'])

@section('content')
    <section class="section parallax-container bg-black section-height-mac" data-parallax-img="/{{ $article->main_image }}">
        <div class="parallax-content">
            <div class="bg-overlay-darker">
                <div class="container section-34 section-md-60 section-lg-115">
                    <h1 class="d-none d-lg-inline-block text-white">{{ $article->title }}</h1>
                    <!-- infos article : date publication, auteur, categories-->
                    <ul class="list-inline list-inline-dashed list-inline-dashed-sm text-small text-white">
                        <li class="text-uppercase">
                            <i class="far fa-calendar-alt"></i>
                            <span class="text-middle inset-left-10">{{ $article->created_at->format('d M Y') }}</span>
                        </li>
                        <li class="text-bottom p text-uppercase">
                            <i class="fas fa-comment-alt"></i>
                            <span class="inset-left-10">
                        {{ __('blog.blog_par') }} <a href="#">{{ $article->user->profile->firstName }}</a>
                    </span>
                        </li>
                        <li class="text-bottom p text-uppercase">
                            <i class="far fa-list-alt"></i>
                            <span class="inset-left-10">
                                @foreach($article->categories as $item)
                                    <a href="#">
                                        {{ @$item->title ? $item->title : 'defaut' }}
                                    </a>
                                @endforeach
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Blog-->
    <section class="section-80 bg-wild-wand text-md-left">
        <div class="container">
            <div class="row justify-content-sm-center">
                <div class="col-md-11 col-lg-9 order-lg-1">
                    <!-- Box qui contient l'article -->
                    <div class="box box-lg box-single-post bg-default d-block">
                        {!! $article->content !!}

                        <div class="d-inline-block inset-md-left-10">
                            <!-- List Inline-->
                            <ul class="list-inline list-inline-modern list-inline-11 bg-wild-wand">
                                <li class="text-center">
                                    <span class="icon icon-sm icon-circle icon-filled-primary">
                                        <img class="img-responsive center-block" src="/images/icons/icon-18-18x15.png" width="18" height="15" alt="">
                                    </span>
                                </li>
                                <li class="text-center">
                                    <a class="icon text-gray" href="#">
                                        <i class="fab fa-facebook-square"></i>
                                    </a>
                                </li>
                                <li class="text-center">
                                    <a class="icon text-gray" href="#">
                                        <i class="fab fa-twitter-square"></i>
                                    </a>
                                </li>
                                <li class="text-center">
                                    <a class="icon text-gray" href="#">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                                <li class="text-center">
                                    <a class="icon text-gray" href="#">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr class="hr bg-alto">
                    <!-- Recent Posts-->
                    <div class="row row-30 justify-content-sm-center justify-content-md-start justify-content-lg-center">
                        @include('partials._three_articles_same_cat')
                    </div>
                    <div class="row justify-content-sm-center text-left">
                        <div class="col-12">
                            <hr class="hr bg-alto">
                            <!-- Box-->
                            <div class="box box-lg box-single-comments bg-default d-block inset-xl-right-60">
                                <h4 class="text-ubold">42 Comments</h4>
                                <!-- Unit-->
                                <div class="unit unit-wide flex-column flex-sm-row unit-spacing-sm">
                                    <div class="unit-left"><img class="img-responsive rounded-circle" src="images/users/user-01-40x40.jpg" width="40" height="40" alt=""></div>
                                    <div class="unit-body">
                                        <form class="rd-mailform form-comment">
                                            <div class="form-wrap form-wrap-xs">
                                                <label class="form-label" for="comment">Enter your comment ...</label>
                                                <input class="form-input inset-right-50" id="comment" type="text" name="comment">
                                            </div>
                                            <button type="submit"><img class="img-responsive center-block img-semi-transparent-inverse" src="images/icons/icon-19-19x19.png" width="19" height="19" alt=""></button>
                                        </form>
                                    </div>
                                </div>
                                <!-- Unit-->
                                <div class="post-comment unit flex-column flex-sm-row unit-spacing-sm">
                                    <div class="unit-left"><img class="img-responsive rounded-circle" src="images/users/user-01-40x40.jpg" width="40" height="40" alt=""></div>
                                    <div class="unit-body">
                                        <p class="text-small text-ubold"><a class="text-black" href="testimonials.html">John Davis</a></p>
                                        <p class="text-extra-small-10 text-silver-chalice">JUNE 21 2016 at 17:02</p>
                                        <p class="text-small text-silver-chalice font-italic">Only been to Dubai on a stopover and wish I had more time. Many people say is “fake” and hides the true reality of the country. Maybe. But I mainly found to be a futuristic “made-from-scratch” urban development project right in the middle of the desert which is fascinating!</p><a class="button-link text-extra-small text-primary text-uppercase" href="#">REPLY</a>
                                    </div>
                                </div>
                                <!-- Unit-->
                                <div class="post-comment unit flex-column flex-sm-row unit-spacing-sm">
                                    <div class="unit-left"><img class="img-responsive rounded-circle" src="images/users/user-02-40x40.jpg" width="40" height="40" alt=""></div>
                                    <div class="unit-body">
                                        <p class="text-small text-ubold"><a class="text-black" href="testimonials.html">Ann Smith</a></p>
                                        <p class="text-extra-small-10 text-silver-chalice">JUNE 20, 2016 at 10:42</p>
                                        <p class="text-small text-silver-chalice font-italic">Fascinating. I was there recently for a conference (at the Atlantis–very nice!). Maybe because it was an international conference, I didn’t see much drinking at all. None during the day. There was a buffet dinner in the hotel disco and alcohol was served but the vast majority of attendees didn’t drink. I met lots of expats living in Dubai who also didn’t drink. I found everything to be exceedingly expensive. I wandered around the mall and didn’t buy a thing because it was all twice as expensive as Europe and it was quite odd. <a class="button-more text-ubold text-big text-gray pull-right" href="#">...</a></p>
                                    </div>
                                </div>
                                <div class="post-comment-inner inset-left-20 inset-sm-left-50 inset-md-left-80 inset-xl-left-115">
                                    <!-- Unit-->
                                    <div class="post-comment">
                                        <div class="unit flex-column flex-sm-row unit-spacing-sm">
                                            <div class="unit-left"><img class="img-responsive rounded-circle" src="images/users/user-01-30x30.jpg" width="30" height="30" alt=""></div>
                                            <div class="unit-body">
                                                <p class="text-small text-ubold"><a class="text-black" href="testimonials.html">John Davis</a></p>
                                                <p class="text-extra-small-10 text-silver-chalice">JUNE 20, 2016 at 12:37</p>
                                                <p class="text-small text-silver-chalice font-italic">Dubai is definitely one of the most expensive cities in UAE, but there are some advantages in visiting it as well. If you are looking for something more European, you can visit Abu Dhabi.</p><a class="button-link text-extra-small text-primary text-uppercase" href="#">REPLY</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Unit-->
                                    <div class="post-comment">
                                        <div class="unit flex-column flex-sm-row unit-spacing-sm">
                                            <div class="unit-left"><img class="img-responsive rounded-circle" src="images/users/user-02-30x30.jpg" width="30" height="30" alt=""></div>
                                            <div class="unit-body">
                                                <p class="text-small text-ubold"><a class="text-black" href="testimonials.html">Ann Smith</a></p>
                                                <p class="text-extra-small-10 text-silver-chalice">JUNE 20, 2016 at 12:39</p>
                                                <p class="text-small text-silver-chalice font-italic">Thanks, I will consider visiting Abu Dhabi, it might be an interesting experience.</p><a class="button-link text-extra-small text-primary text-uppercase" href="#">REPLY</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inset-xl-right-305">
                                        <!-- Unit-->
                                        <div class="unit unit-wide flex-column flex-sm-row unit-xs-spacing-sm">
                                            <div class="unit-left"><img class="img-responsive rounded-circle" src="images/users/user-01-30x30.jpg" width="30" height="30" alt=""></div>
                                            <div class="unit-body">
                                                <form class="rd-mailform form-comment form-comment-comment-inner">
                                                    <div class="form-wrap form-wrap-xxs">
                                                        <label class="form-label" for="comment-inner">Enter your comment ...</label>
                                                        <input class="form-input inset-right-30" id="comment-inner" type="text" name="comment-inner">
                                                    </div>
                                                    <button type="submit"><img class="img-responsive center-block img-semi-transparent-inverse" src="images/icons/icon-21-10x10.png" width="10" height="10" alt=""></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Unit-->
                                <div class="post-comment unit flex-column flex-sm-row unit-spacing-sm">
                                    <div class="unit-left"><img class="img-responsive rounded-circle" src="images/users/user-03-40x40.jpg" width="40" height="40" alt=""></div>
                                    <div class="unit-body">
                                        <p class="text-small text-ubold"><a class="text-black" href="testimonials.html">Kent Fleming</a></p>
                                        <p class="text-extra-small-10 text-silver-chalice">JUNE 18, 2016 at 21:19</p>
                                        <p class="text-small text-silver-chalice font-italic">Although many people said Dubai is artificial, I still really want to go there and Dubai is absolutely on my list. I’m sure Dubai has got something interesting. Yes, a lot of tourists say it’s fake and has a pseudo-European style but I believe Dubai hides more than it shows during the first visit. Thanks for the inspiring post! it was a pleasure to read some interesting and unknown facts about the city which is #1 on my “must travel” list. <a class="button-more text-ubold text-big text-gray pull-right" href="#">...</a></p>
                                        <ul class="list-inline post-box-meta list-inline-dashed list-inline-dashed-xs text-extra-small-10 text-silver-chalice">
                                            <li class="p text-uppercase"><a class="button-link text-extra-small text-primary text-uppercase" href="#"><img src="images/icons/icon-20-14x11.png" width="14" height="11" alt=""><span class="text-middle inset-left-10">8 replies</span></a></li>
                                            <li class="text-bottom p text-uppercase"><a class="button-link text-extra-small text-primary text-uppercase" href="#">REPLY</a></li>
                                        </ul><a class="button button-img button-img-left button-primary" href="#" style="padding-top: 5px;padding-bottom: 5px;"><span class="button-img-wrap"><img src="images/icons/icon-17-16x15-light.png" width="16" height="15" alt=""></span><span>VIEW NEXT 35 COMMENTS</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- debut Aside Blog -->
                @include('partials._blog_aside')
            </div>
        </div>
    </section>
@endsection