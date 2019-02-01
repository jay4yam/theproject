<div id="grid-view" class="row row-30 row-offset-1 justify-content-sm-center justify-content-md-start justify-content-lg-center">
@foreach($allVoyages->load('region', 'ville') as $voyage)
    <!-- Box voyage grid -->
        <div class="col-md-6 col-lg-3">
            <div class="box-offer box-offer-xs">
                <div class="box-offer-img-wrap">
                    <a href="{{ route('front.voyage.show', ['id' => $voyage->id, 'locale' => App::getLocale(), 'slug' => str_slug($voyage->title)]) }}">
                        <img class="img-responsive center-block" src="/storage/voyages/thumbnails/{{ $voyage->main_photo }}" width="270" height="240" alt="">
                    </a>
                </div>
                <div class="mini-cart icon-square">
                    <a href="#" class="add-to-cart" data-toggle="modal" data-content="{{ $voyage->id }}" data-target="#modal-cart">
                        <i class="fas fa-shopping-cart defaut"></i>
                        <i class="fas fa-cart-arrow-down over"></i>
                    </a>
                </div>
                <div class="box-offer-caption text-left">
                    <div class="">
                        <div class="box-offer-title text-ubold">
                            <a class="text-black text-center" href="{{ route('front.voyage.show', ['id' => $voyage->id, 'locale' => App::getLocale(), 'slug' => str_slug($voyage->title)]) }}">
                                {{ str_limit($voyage->title,27) }}
                            </a>
                        </div>
                    </div>
                    <div class="pull-right">
                        @if($voyage->is_discounted)
                            <div id="discounted"></div>
                            <div id="discounted_price">{{ number_format($voyage->discount_price, 0, ',', ' ') }} €</div>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <!-- List Inline-->
                    <ul class="text-center list-inline list-inline-13 list-inline-marked list-inline-marked-offset-inverse-top text-silver-chalice text-extra-small">
                        <li>{{ @$voyage->region->first()->name }}</li>
                        <li>{{ $voyage->ville->name }}</li>
                        <li>
                            @if($voyage->is_discounted)
                                <div class="box-offer-price text-primary text-strike">{{ number_format($voyage->price, 2, ',', ' ') }} €</div>
                            @else
                                <div class="box-offer-price text-primary">{{ number_format($voyage->price, 2, ',', ' ') }} €</div>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>