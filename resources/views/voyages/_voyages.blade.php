<div id="grid-view" class="row row-30 row-offset-1 justify-content-sm-center justify-content-md-start justify-content-lg-center">
    @foreach($allVoyages as $voyage)
        <!-- Box voyage grid -->
        <div class="col-md-6 col-lg-4">
            <div class="box-offer box-offer-xs">
                <div class="box-offer-img-wrap">
                    <a href="{{ route('voyage.show', ['id' => $voyage->id, 'locale' => App::getLocale(), 'slug' => str_slug($voyage->title)]) }}">
                        <img class="img-responsive center-block" src="/storage/voyages/{{ $voyage->main_photo }}" width="270" height="240" alt="">
                    </a>
                </div>
                <div class="box-offer-caption text-left">
                    <div class="pull-left">
                        <div class="box-offer-title text-ubold">
                            <a class="text-black" href="{{ route('voyage.show', ['id' => $voyage->id, 'locale' => App::getLocale(), 'slug' => str_slug($voyage->title)]) }}">
                                {{ $voyage->title }}
                            </a>
                        </div>
                    </div>
                    <div class="pull-right">
                        @if($voyage->is_discounted)
                        <div id="discounted"></div>
                        <div id="discounted_price">{{ number_format($voyage->discount_price, 0, ',', ' ') }} €</div>
                        <div class="box-offer-price text-primary text-strike">{{ number_format($voyage->price, 2, ',', ' ') }} €</div>
                        @else
                            <div class="box-offer-price text-primary">{{ number_format($voyage->price, 2, ',', ' ') }} €</div>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <!-- List Inline-->
                    <ul class="list-inline list-inline-13 list-inline-marked list-inline-marked-offset-inverse-top text-silver-chalice text-extra-small">
                        <li>{{ @$voyage->region->first()->name }}</li>
                        <li>{{ $voyage->ville->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>


<div id="list-view" class="row row-30 row-lg-20 row-offset-1 justify-content-sm-center justify-content-md-start justify-content-lg-center">
    @foreach($allVoyages as $voyage)
        <!-- Box voyage list -->
        <div class="col-sm-10 col-md-6 col-xl-12">
        <!-- Box Offer-->
        <div class="box-offer box-offer-sm box-offer-left">
            <div class="box-offer-img-wrap">
                <a href="{{ route('voyage.show', ['id' => $voyage->id, 'locale' => App::getLocale(), 'slug' => str_slug($voyage->title)]) }}">
                    <img class="img-responsive center-block" src="/storage/voyages/{{ $voyage->main_photo }}" width="270" height="280" alt="">
                </a>
            </div>
            <div class="box-offer-caption text-left">
                <div class="box-offer-caption-inner-wrap">
                    <div class="box-offer-caption-inner-left">
                        <p class="text-extra-small text-silver-chalice"></p>
                        <div class="box-offer-title text-ubold">
                            <a class="text-black" href="{{ route('voyage.show', ['id' => $voyage->id, 'locale' => App::getLocale(), 'slug' => str_slug($voyage->title)]) }}">
                                {{ $voyage->title }}
                            </a>
                        </div>
                        <!-- List Inline-->
                        <ul class="list-inline list-inline-3">
                            <li><a class="icon fa fa-star text-primary" href="#"></a></li>
                            <li><a class="icon fa fa-star text-primary" href="#"></a></li>
                            <li><a class="icon fa fa-star text-primary" href="#"></a></li>
                            <li><a class="icon fa fa-star text-primary" href="#"></a></li>
                        </ul>
                    </div>
                    <div class="box-offer-caption-inner-right text-right">
                        <p class="text-extra-small text-spacing-10 text-silver-chalice">Durée du vol : <b>{{ $voyage->duree_du_vol }} .min</b></p>
                        <!-- List Inline -->
                        @if($voyage->is_discounted)
                            <ul class="list-inline inset-right-5">
                                <li class="text-extra-small text-black text-strike text-middle">{{ number_format($voyage->price, 2, ',', ' ') }} €</li>
                                <li class="box-offer-price text-black text-ubold text-primary text-middle">{{ number_format($voyage->discount_price, 2, ',', ' ') }} €</li>
                            </ul>
                        @else
                            <ul class="list-inline inset-right-5">
                                <li class="box-offer-price text-black text-ubold text-primary text-middle">{{ number_format($voyage->discount_price, 2, ',', ' ') }} €</li>
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="box-offer-caption-inner-wrap box-offer-caption-inner-wrap-bottom">
                    <div class="box-offer-caption-inner-left box-offer-description">
                        <p class="text-small text-silver-chalice">
                            {{ $voyage->intro }}
                        </p>
                    </div>
                    <div class="box-offer-caption-inner-right text-xl-right">
                        <a class="button button-width-110 button-primary" href="{{ route('voyage.show', ['id' => $voyage->id, 'locale' => App::getLocale(), 'slug' => str_slug($voyage->title)]) }}">
                            VIEW MORE
                        </a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    @endforeach
</div>