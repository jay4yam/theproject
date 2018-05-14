<!-- Affichage liste par defaut -->
<div class="list-view row row-30 row-offset-1 justify-content-sm-center justify-content-md-between">
<!-- Post Box-->
    @php $temp=0.2; @endphp
    @foreach($allArticles as $article)
        <div class="col-sm-8 col-md-6 col-xl-12 list-a-view wow bounceInUp" data-wow-delay="{{ $temp }}s">
            <div class="post-box post-box-wide post-blog-left text-left">
                <div class="post-box-img-wrap">
                    <a href="/{{ App::getLocale() }}/blog/{{ $article->id }}/{{ str_slug($article->title) }}">
                        <img src="/storage/blog/thumbnails/{{ $article->main_image }}" width="270" height="315" alt=""/>
                    </a>
                </div>
                <div class="post-box-caption">
                    <div class="post-box-title h5 text-ubold">
                        <a class="text-black" href="/{{ App::getLocale() }}/blog/{{ $article->id }}/{{ str_slug($article->title) }}">
                            [{{$article->id}}] {{ $article->title }}
                        </a>
                    </div>
                    <ul class="list-inline post-box-meta list-inline-dashed list-inline-dashed-sm text-extra-small text-silver-chalice">
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
                                        {{ $item->title }}
                                    </a>
                                @endforeach
                            </span>
                        </li>
                    </ul>
                    <p class="text-small text-silver-chalice">
                        {!! str_limit($article->intro, 160)  !!}
                    </p>
                    <a class="button button-primary button-width-110" href="/{{ App::getLocale() }}/blog/{{ $article->id }}/{{ str_slug($article->title) }}">
                        {{ __('blog.blog_lire_plus') }}
                    </a>
                </div>
            </div>
        </div>
        @php $temp += 0.3 @endphp
    @endforeach
</div>

<!-- Affichage grid  -->
<div class="row row-30 row-offset-1 justify-content-sm-center justify-content-md-start justify-content-lg-center">
    @php $temp1 =0; @endphp
    @foreach($allArticles as $article)
        <div class="col-md-6 col-lg-4 grid-a-view wow bounceInRight" data-wow-delay="{{ $temp1 }}s">
            <div class="inset-left-10 inset-right-10 inset-sm-left-50 inset-sm-right-50 inset-md-left-20 inset-md-right-20 inset-lg-left-0 inset-lg-right-0">
                <!-- Post Box-->
                <div class="post-box d-block text-left">
                    <div class="post-box-img-wrap">
                        <a href="/{{ App::getLocale() }}/blog/{{ $article->id }}/{{ str_slug($article->title) }}">
                            <img src="/storage/blog/thumbnails/{{ $article->main_image }}" width="270" height="240" alt="">
                        </a>
                    </div>
                    <div class="post-box-caption">
                        <div class="post-box-title text-ubold">
                            <a class="text-black" href="/{{ App::getLocale() }}/blog/{{ $article->id }}/{{ str_slug($article->title) }}">
                                {{ str_limit($article->title,55) }}
                            </a>
                        </div>
                        <ul class="list-inline post-box-meta list-inline-dashed list-inline-dashed-xs text-extra-small-10 text-silver-chalice">
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
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @php $temp1 += 0.5 @endphp
    @endforeach
</div>

<!-- Affichage big liste -->
<div class="big-list-view">
    @php $temp2 =0; @endphp
    @foreach($allArticles as $article)
        <div class="post-box post-box-wide d-block text-left wow bounceInUp" data-wow-delay="{{ $temp2 }}s">
            <div class="post-box-img-wrap img-block">
                <a href="/{{ App::getLocale() }}/blog/{{ $article->id }}/{{ str_slug($article->title) }}">
                    <img src="/storage/blog/{{ $article->main_image }}" width="1170" alt="{{ $article->slug }}">
                </a>
            </div>
            <div class="post-box-caption">
                <div class="post-box-title h5 text-ubold">
                    <a class="text-black" href="/{{ App::getLocale() }}/blog/{{ $article->id }}/{{ str_slug($article->title) }}">
                        {{ $article->title }}
                    </a>
                </div>
                <ul class="list-inline post-box-meta list-inline-dashed list-inline-dashed-sm text-extra-small text-silver-chalice">
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
                                    {{ $item->title }}
                                </a>
                            @endforeach
                        </span>
                    </li>
                </ul>
                <p class="text-small text-silver-chalice">
                    {!! $article->intro  !!}
                </p>
                <a class="button button-primary button-width-110" href="/{{ App::getLocale() }}/blog/{{ $article->id }}/{{ str_slug($article->title) }}">
                    {{ __('blog.blog_lire_plus') }}
                </a>
            </div>
        </div>
        @php $temp2 += 0.2 @endphp
@endforeach
</div>