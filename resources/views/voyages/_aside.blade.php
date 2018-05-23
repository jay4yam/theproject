<div class="col-md-10 col-lg-3 text-lg-left">

    <aside class="blog-aside box box-xs d-block bg-default">
        <div class="blog-aside-item">
            <p class="text-black text-ubold text-uppercase text-spacing-200">{{ __('voyage.search') }}</p>
            <!-- RD Search Form-->
            <form class="rd-mailform">
                <div class="form-blog-search">
                    <button class="form-search-submit">
                        <span>
                            <img class="img-responsive center-block" src="/images/icons/icon-34-16x21.png" width="16" height="21" alt="">
                        </span>
                    </button>
                    <div class="form-wrap form-wrap-xs">
                        <label class="form-label form-search-label form-label-sm" for="tours-destination">{{ __('voyage.destination') }}</label>
                        <input class="form-search-input input-sm form-input" id="tours-destination" type="text">
                    </div>
                </div>
            </form>
        </div>
        <hr class="hr bg-gallery">
        <div class="blog-aside-item box-range">
            <p class="text-black text-ubold text-uppercase text-spacing-200">{{ __('voyage.price_range') }}</p>
            <!--RD Range-->
            <div class="rd-range" data-min="{{ $minPrice }}" data-max="{{ $maxPrice }}" data-start="[{{ $minPrice }}, {{ $maxPrice }}]" data-step="1" data-tooltip="true" data-min-diff="30" data-input=".rd-range-input-value-1" data-input-2=".rd-range-input-value-2"></div>
        </div>
        <hr class="hr bg-gallery">
        <div class="blog-aside-item">
            <p class="text-black text-ubold text-uppercase text-spacing-200">Villes</p>
            <!-- List-->
            <ul class="list list-1 list-checkbox text-left">
                @foreach($villes as $ville => $value)
                    <li>
                        <label class="checkbox-inline checkbox-inline-left">
                            <input class="checkbox-custom" name="remember" value="{{ $value['id'] }}" type="checkbox">
                            <span class="text-small">{{ $ville }} ({{ $value['count'] }})</span>
                        </label>
                    </li>
                @endforeach
            </ul>
            <a class="button button-primary button-width-110" href="#">Search</a>
        </div>
    </aside>
</div>