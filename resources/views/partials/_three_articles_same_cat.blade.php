@foreach($articles as $article)
    <div class="col-md-6 col-lg-4">
        <div class="inset-left-10 inset-right-10 inset-sm-left-50 inset-sm-right-50 inset-md-left-20 inset-md-right-20 inset-lg-left-0 inset-lg-right-0">
            <!-- Post Box-->
            <div class="post-box d-block text-left">
                <div class="post-box-img-wrap">
                    <a href="/{{ App::getLocale() }}/blog/{{ $article->id }}/{{ str_slug($article->title) }}">
                        <img src="/images/blog/post-01-270x240.jpg" width="270" height="240" alt=""/>
                    </a>
                </div>
                <div class="post-box-caption">
                    <div class="post-box-title text-ubold">
                        <a class="text-black" href="/{{ App::getLocale() }}/blog/{{ $article->id }}/{{ str_slug($article->title) }}">
                            {{ str_limit($article->title, 60) }}
                        </a>
                    </div>
                    <ul class="list-inline post-box-meta list-inline-dashed list-inline-dashed-xs text-extra-small-10 text-silver-chalice">
                        <li class="text-uppercase">{{ $article->created_at->format('d M Y') }}</li>
                        <li class="p text-uppercase"><span>{{ __('blog.blog_par') }} <a href="#">{{ $article->user->profile->firstName }}</a></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endforeach