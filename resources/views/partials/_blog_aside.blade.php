<div class="col-md-11 col-lg-3 text-lg-left">
    <!-- Aside-->
    <aside class="blog-aside box box-xs d-block bg-default">
        <div class="blog-aside-item">
            <p class="text-black text-ubold text-uppercase text-spacing-200">{{ __('blog.blog_search') }}</p>
            <!-- RD Search Form-->
            <form class="form-blog-search form-blog-search-type-2 form-search rd-search" action="search-results.html" method="GET">
                <button class="form-search-submit" type="submit"><span class="fa fa-search"></span></button>
                <div class="form-wrap form-wrap-xs">
                    <label class="form-label form-search-label form-label-sm" for="blog-sidebar-form-search-widget">{{ __('blog.blog_request') }}</label>
                    <input class="form-search-input input-sm form-input input-sm" id="blog-sidebar-form-search-widget" type="text" name="s" autocomplete="off">
                </div>
            </form>
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
                <div class="group group-xs button-tags text-left"><a class="button button-sm button-gray" href="#">Travel</a><a class="button button-sm button-gray" href="#">Adventure</a><a class="button button-sm button-gray" href="#">Relax</a><a class="button button-sm button-gray" href="#">Brasil</a><a class="button button-sm button-gray" href="#">Trip</a><a class="button button-sm button-gray" href="#">Honeymoon</a><a class="button button-sm button-gray" href="#">Promotions</a><a class="button button-sm button-gray" href="#">North America</a></div>
            </div>
        </div>
    </aside>
</div>