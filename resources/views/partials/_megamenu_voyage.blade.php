<div class="rd-navbar-megamenu">
    <div class="row">
        @foreach($items as $pays => $array)
        <div class="col-lg-4" style="border-right: #e9ecef 1px solid;">
            <p class="rd-megamenu-header text-big text-black text-ubold">{{ strtoupper($pays) }}</p>
            <div class="col-12">
                <div class="row">
                    @foreach($array as $ville => $voyages)
                        <div class="col-6" style="padding: 10px 0;">
                            <h5 class="menu-ville">
                                <a href="{{ route('front.voyage.show.ville', [ 'locale' => App::getLocale(), 'id' => $arrayVille[$ville], 'ville' => $ville]) }}">{{ $ville }}</a>
                            </h5>
                            <ul>
                            @foreach($voyages as $voyage)
                                <li>
                                    <a href="{{ route('front.voyage.show', ['locale' => App::getLocale(), 'id' => $voyage['id'], 'slug' => str_slug($voyage['title'])]) }}">
                                    {{ $voyage['title'] }}
                                    </a>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-lg-4">
            @foreach($decoratives as $voyage)
                <div class="col-12 bg-decorative" style="background-image: url('/storage/voyages/{{ $voyage->main_photo }}');">
                    <a href="{{ route('front.voyage.show', ['locale' => App::getLocale(), 'id' => $voyage->id, 'slug' => str_slug($voyage->title)]) }}">
                        {{ ucfirst($voyage->title) }}
                    </a>
                    <div class="price">{{ $voyage->price }} €</div>
                </div>
            @endforeach
        </div>
    </div>
</div>