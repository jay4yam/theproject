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
            <p class="text-black text-ubold text-uppercase text-spacing-200">Villes</p>
            <!-- List-->
            {{ Form::open(['route' => ['front.voyage.ville'], 'method' => 'get']) }}
            <ul class="list list-1 list-checkbox text-left">
                @foreach($villes as $ville => $value)
                    <li>
                        <label class="checkbox-inline checkbox-inline-left">
                            <input class="checkbox-custom" name="ville[]" value="{{ $value['id'] }}" type="checkbox">
                            <span class="text-small">{{ $ville }} ({{ $value['count'] }})</span>
                        </label>
                    </li>
                @endforeach
            </ul>
            <button class="button button-primary button-width-110" type="submit">{{ __('voyage.filter') }}</button>
            {{ Form::close() }}
        </div>
    </aside>
</div>
@section('dedicated_js')
    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
    <script>

        $(document).ready(function () {

            function split( val ) {
                return val.split( /,\s*/ );
            }
            function extractLast( term ) {
                return split( term ).pop();
            }

            //Autocomplete en ajax
            $('#tours-destination').autocomplete({
                minLength: 0,
                //la source est une url qui renvois la liste des voyage
                source: function (request, response) {
                    //utilisation d'une requête ajax pour recup la liste
                    $.ajax({
                        url: '/ajax/voyage-get-list-voyage',
                        dataType: 'json',
                        //recupère la liste via la variable 'data' qui est un tableau
                        success: function (data) {
                            //il faut utiliser la fonction native $.map pour itérer sur le tableau
                            var array = $.map(data, function (item) {
                                return {
                                    label: item.label,
                                    value: item.value
                                };
                            });

                            //traitement de la réponse pour avoir le multi select
                            response( $.ui.autocomplete.filter(array, extractLast( request.term ) ) );
                        }
                    });
                },
                //affiche le spinner lors de la recherche
                search: function( event, ui ) {
                    $('.spinner').show();
                },
                //masque le spinner lors de la fin de la recherche
                response: function(event, ui) {
                    $('.spinner').hide();
                },
                //
                focus: function(event, ui) {
                    return false;
                },
                select: function (event, ui) {

                    var terms = split( this.value );
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push( ui.item.value );
                    // add placeholder to get the comma-and-space at the end
                    terms.push( "" );
                    this.value = terms.join( ", " );

                    //récupère la valeur ville_id
                    var ville_id = ui.item.value.split('-')[0];

                    //cree in input hidden qui sera ajouter au form pour le submit
                    var input = '<input class="checkbox-custom" id="ville_id" name="ville[]" value="'+ ville_id+'" type="hidden">';

                    //ajoute l'input au form
                    $('#ajaxsearch').append(input);

                    return false;
                }
            }).on('keydown', function( event ) {
                // si dans l'input l'utilisateur tape sur "enter", on soumet automatiquement le formulaire
                if ( event.keyCode === $.ui.keyCode.ENTER){
                    $('#ajaxsearch').submit();
                }
            });

            $( function() {
                $('.slider').slider({
                    range: true,
                    animate: "fast",
                    min: <?php echo $minPrice ?> ,
                    max: <?php echo $maxPrice ?> ,
                    values: [ <?php echo $minPrice ?>, <?php echo $maxPrice ?> ],
                    slide: function( event, ui ) {
                        $( "#amount" ).val(  ui.values[ 0 ] + " € - " + ui.values[ 1 ] + " €" );
                    },
                    change: function( event, ui ) {
                        $('#price_min').val(ui.values[0]);
                        $('#price_max').val(ui.values[1]);
                    }
                });
            } );
        });
    </script>
@endsection