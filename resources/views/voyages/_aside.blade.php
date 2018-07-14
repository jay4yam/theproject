@section('dedicated_css')
    <link rel="stylesheet" href="{{ asset('/css/jquery-ui-theme.css') }}">
@endsection

<div class="col-md-10 col-lg-3 text-lg-left">

    <aside class="blog-aside box box-xs d-block bg-default">
        <div class="blog-aside-item">
            <p class="text-black text-ubold text-uppercase text-spacing-200">{{ __('voyage.search') }}</p>
            <!-- RD Search Form-->
            {{ Form::open(['route' => ['front.voyage.ville'], 'method' => 'get', 'id' => 'ajaxsearch']) }}
                <div class="form-blog-search">
                    <button class="form-search-submit">
                        <span>
                            <img class="img-responsive center-block" src="/images/icons/icon-34-16x21.png" width="16" height="21" alt="">
                        </span>
                    </button>
                    <div class="form-wrap form-wrap-xs">
                        <label class="form-label form-search-label form-label-sm" for="tours-destination">{{ __('voyage.destination') }}</label>
                        <input class="form-search-input input-sm form-input" id="tours-destination" type="text">
                        <div class="spinner"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></div>
                    </div>
                </div>
                @if( request()->has('ville'))
                <div class="reset-button"><a href="{{ url()->route('front.voyage.index') }}">reset</a></div>
                @endif
            {{ Form::close() }}
        </div>
        <hr class="hr bg-gallery">
        <div class="blog-aside-item box-range">
            {{ Form::open(['route' => 'front.voyage.price', 'method' => 'get', 'id' => 'prices']) }}
                {{ Form::hidden('price_min', null, ['id' => 'price_min']) }}
                {{ Form::hidden('price_max', null, ['id' => 'price_max']) }}
                <p class="text-black text-ubold text-uppercase text-spacing-200">{{ __('voyage.price_range') }}</p>
                <!-- slider -->
                <div class="slider"></div>
                <input type="text" id="amount" readonly style="padding-top:10px; border:0; color:#f6931f; font-weight:bold;" value="{{ $minPrice }} € - {{ $maxPrice }} €">
                <button class="button button-primary button-width-110" type="submit">{{ __('voyage.filter') }}</button>
            {{ Form::close() }}
        </div>
        <hr class="hr bg-gallery">
        <div class="blog-aside-item">
            <p class="text-black text-ubold text-uppercase text-spacing-200">{{ __('voyage.ville') }}</p>
            <!-- List-->
            {{ Form::open(['route' => ['front.voyage.ville'], 'method' => 'get']) }}
            <ul class="list list-1 list-checkbox text-left">
                @foreach($villes as $ville => $value)
                    <li>
                        <label class="checkbox-inline checkbox-inline-left">
                            <input class="checkbox-custom" name="ville[]" value="{{ $value['id'] }}" type="checkbox">
                            <span class="text-small">{{ $ville }} - {{ $value['region'] }} ({{ $value['count'] }})</span>
                        </label>
                    </li>
                @endforeach
            </ul>
            <button class="button button-primary button-width-110" type="submit">{{ __('voyage.filter') }}</button>
            {{ Form::close() }}
        </div>
    </aside>
</div>