<div class="col-sm-8 col-md-6 col-xl-12">
    <!-- Post Box-->
    <div class="post-box post-box-wide post-blog-left text-left">
        <div class="post-box-img-wrap">
            <a href="/{{ App::getLocale() }}/{{ $article->id }}/{{ str_slug($article->title) }}">
                <img src="/images/blog/post-06-270x315.jpg" width="270" height="315" alt=""/>
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
                {{ str_limit($article->intro, 160) }}
            </p>
            <a class="button button-primary button-width-110" href="/{{ App::getLocale() }}/blog/{{ $article->id }}/{{ str_slug($article->title) }}">
                {{ __('blog.blog_lire_plus') }}
            </a>
        </div>
    </div>
</div>