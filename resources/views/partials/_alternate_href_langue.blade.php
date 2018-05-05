@foreach($alternateTags as $langue => $value)
    @php
        $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];

        $segments = request()->segments();

        $url = '';

        for($i = 1; $i < count($segments); $i++)
        {
            $url .= '/'.$i;
        }
    @endphp
    <link rel="alternate" hreflang="{{ $value }}" href="{{ $root.'/'.$langue.'/'.$url }}"/>
@endforeach