@switch(App::getLocale())
    @case('fr')
    <a href="/fr/{{ $currentRoute }}" style="float: left">
        <img src="{{ asset('images/french_flag.png') }}" height="15">
    </a>
    @break
    @case('en')
    <a href="/en/{{ $currentRoute }}" style="float: left">
        <img src="{{ asset('images/uk_flag.png') }}" height="15">
    </a>
    @break
    @case('es')
    <a href="/es/{{ $currentRoute }}" style="float: left">
        <img src="{{ asset('images/spanish_flag.png') }}" height="15">
    </a>
    @break
@endswitch
<div class="languages_items">
    @foreach($allLangues as $cle => $langue)
        @switch($cle)
            @case('fr')
            <a href="/fr/{{ $currentRoute }}" style="float: left">
                <img src="{{ asset('images/french_flag.png') }}" height="15">
            </a>
            @break
            @case('en')
            <a href="/en/{{ $currentRoute }}" style="float: left">
                <img src="{{ asset('images/uk_flag.png') }}" height="15">
            </a>
            @break
            @case('es')
            <a href="/es/{{ $currentRoute }}" style="float: left">
                <img src="{{ asset('images/spanish_flag.png') }}" height="15">
            </a>
            @break
        @endswitch
    @endforeach
</div>