@extends('layouts.other', [
                            'title' => ' On va vous donner envie de voler avec nous | Blog easyCopter',
                            'activeBlogCss' => 'active'
                            ])

@section('content')
    <section class="section parallax-container bg-black section-height-mac" data-parallax-img="{{ Storage::url($article->main_image) }}">
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
                                    <a href="{{ route('blog.categorie', ['locale' => App::getLocale(), 'id' => $item->id, 'categorie' => str_slug($item->title)]) }}">
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

                    <!-- Commentaire -->
                    <div class="row justify-content-sm-center text-left">
                        <div class="col-12">
                            <hr class="hr bg-alto">
                            <!-- Box-->
                            <div class="box box-lg box-single-comments bg-default d-block inset-xl-right-60">
                                <h4 class="text-ubold">{{ $article->comments()->count() }} Comments</h4>
                                <!-- form -->
                                <div class="unit unit-wide flex-column flex-sm-row unit-spacing-sm">
                                    <div class="unit-left">
                                        <img class="img-responsive rounded-circle" src="/images/users/user-01-40x40.jpg" width="40" height="40" alt="">
                                    </div>
                                    <div class="unit-body">
                                        @if(Auth::check())
                                        {{ Form::open(['url' => App::getLocale().'/add-comment', 'locale' => App::getLocale(), 'method' => 'post', 'class' => 'form-comment' ]) }}
                                            <div class="form-wrap form-wrap-xs">
                                                <label class="form-label rd-input-label" for="content">Enter your comment ...</label>
                                                <input class="form-input inset-right-50" id="content" type="text" name="content">
                                            </div>
                                            <button type="submit">
                                                <img class="img-responsive center-block img-semi-transparent-inverse" src="/images/icons/icon-19-19x19.png" width="19" height="19" alt="">
                                            </button>
                                        {{ Form::close() }}
                                        @else
                                            <span>You need to be connected to comment</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- liste des commentaires-->
                                @foreach($article->comments->where('reply_to', null)->load('user') as $comment)
                                    <div class="post-comment unit flex-column flex-sm-row unit-spacing-sm">
                                        <div class="unit-left">
                                            <img class="img-responsive rounded-circle" src="/images/users/user-01-40x40.jpg" width="40" height="40" alt="">
                                        </div>
                                        <div class="unit-body">
                                            <p class="text-small text-ubold"><a class="text-black" href="testimonials.html">{{ $comment->user->email }}</a></p>
                                            <p class="text-extra-small-10 text-silver-chalice">{{ $comment->created_at->format('d M Y à h:m') }}</p>
                                            <p class="text-small text-silver-chalice font-italic">
                                                {{  $comment->content }}
                                                @if($comment->getRepliedComments($comment->id)->count())
                                                <a class="button-more text-ubold text-big text-gray pull-right" href="#" id="showcomment-{{ $comment->id }}">...</a>
                                                @endif
                                            </p>
                                            <a class="button-link text-extra-small text-primary text-uppercase" href="#">REPLY</a>
                                        </div>
                                    </div>
                                    @if($comment->getRepliedComments($comment->id)->count())
                                        <div id="repliedComment-{{ $comment->id }}" class="obfuscated post-comment-inner inset-left-20 inset-sm-left-50 inset-md-left-80 inset-xl-left-115">
                                        @foreach($comment->getRepliedComments($comment->id)->load('user') as $reply)
                                            <!-- reply -->
                                            <div class="post-comment">
                                                <div class="unit flex-column flex-sm-row unit-spacing-sm">
                                                    <div class="unit-left">
                                                        <img class="img-responsive rounded-circle" src="/images/users/user-01-30x30.jpg" width="30" height="30" alt="">
                                                    </div>
                                                    <div class="unit-body">
                                                        <p class="text-small text-ubold"><a class="text-black" href="#">{{ $reply->user->email }}</a></p>
                                                        <p class="text-extra-small-10 text-silver-chalice">{{ $comment->created_at->format('d M Y à h:m') }}</p>
                                                        <p class="text-small text-silver-chalice font-italic">
                                                            {{ $reply->content }}
                                                        </p>
                                                        <a class="button-link text-extra-small text-primary text-uppercase" href="#">REPLY</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                    @endif
                                @endforeach
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

@section('dedicated_js')
    <script>
        $(document).ready(function () {
            $('a[id^="showcomment-"]').on('click', function (e) {
                e.preventDefault();
                var name = $(this).attr('id');
                var array = name.split('-');

                $('#repliedComment-'+array[1]).toggle();
            });
        })
    </script>
@endsection