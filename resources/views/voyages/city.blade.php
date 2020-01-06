@extends('layouts.other', [
                'title' => 'Vol en Hélicoptère, Baptême, Liste de nos voyages | easyCopter',
                'activeVoyageCss' => 'active'
                ])

@section('dedicated_css')
    <link rel="stylesheet" href="{{ asset('/css/jquery-ui-theme.css') }}">
@endsection

@section('content')
    <section class="section parallax-container bg-black section-height-mac context-dark" data-parallax-img="/storage/{{ $ville->main_photo }}">
        <div class="parallax-content">
            <div class="bg-overlay-darker">
                <div class="container section-34 section-md-100 section-lg-top-170 section-lg-bottom-165">
                    <h1 class="d-none d-lg-inline-block">{{ $ville->name }}</h1>
                    <h2>{{ $ville->title }}</h2>
                    <h6 class="font-italic">{{ $ville->subtitle }}</h6>
                </div>
            </div>
        </div>
    </section>

    <!-- Tours Grid Variant 2-->
    <section class="section-80 section-md-bottom-70 bg-wild-wand">
        <div class="container">
            <div class="row row-50 justify-content-sm-center">
                <!-- Content -->
                <div class="col-md-11 col-lg-9 order-lg-1">
                    <div class="row row-20 justify-content-sm-between">
                        <div class="col-md-6 col-md-3 text-md-left">
                            <div class="d-inline-block inset-md-left-20 inset-lg-left-0">
                                <div class="pull-left inset-right-10">
                                    <p class="text-extra-small text-uppercase text-black">{{ __('voyage.sort_by') }}</p>
                                </div>
                                <div class="pull-right shadow-drop-xs d-inline-block select-xs">
                                    <!--Select 2-->
                                    <select class="form-input select-filter" data-minimum-results-for-search="Infinity" data-constraints="@Required">
                                        <option value="2">{{ __('voyage.popular') }}</option>
                                        <option value="3">{{ __('voyage.newest') }}</option>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-3 text-md-right">
                            <div class="d-inline-block inset-md-right-20 inset-lg-right-0">
                                <div class="pull-left inset-right-10">
                                    <p class="text-extra-small text-uppercase text-black">{{ __('voyage.vue') }}</p>
                                </div>
                                <div class="pull-right">
                                    <!-- List view type -->
                                    <ul class="list-inline list-primary-filled text-center list-top-panel">
                                        <li>
                                            <a class="shadow-drop-lg" href="{{ url()->current() . '?' . http_build_query(['view' => 'list']) }}" id="show-list">
                                                <span class="icon icon-sm icon-square mdi mdi-format-list-bulleted"></span>
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a class="shadow-drop-lg" href="{{ url()->current() . '?' . http_build_query(['view' => 'grid']) }}" id="show-grid">
                                                <span class="icon icon-sm icon-square mdi mdi-view-module"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                @include('voyages._voyages')

                <!-- Classic Pagination-->
                    <div class="paginate" align="center">
                        {{ $allVoyages->appends(request()->input())->links() }}
                    </div>
                    <!-- Classic Pagination-->
                </div>

                <!-- Aside -->
            @include('voyages._aside')
            <!-- fin Aside -->
            </div>
            @if(request('ville'))
                <div class="description-voyage">
                    <p>{!! $ville->first()->description  !!}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- MODAL PANIER -->
    @include('partials._modal-add-to-cart')

@endsection

@section('dedicated_js')
    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        function urlParam(name){
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            if (results==null){
                return null;
            }
            else{
                return decodeURI(results[1]) || 0;
            }
        }

        function testParam() {
            if( urlParam('view') === 'list'){
                //affiche ou masque le div correspondant
                $('#grid-view').hide();
                $('#list-view').show();

                $('#show-grid').parent('li').removeClass('active');
                $('#show-list').parent('li').addClass('active');
            }

            if( urlParam('view') === 'grid'){
                //affiche ou masque le div correspondant
                $('#list-view').hide();
                $('#grid-view').show();

                $('#show-list').parent('li').removeClass('active');
                $('#show-grid').parent('li').addClass('active');
            }

        }

        testParam();

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
                            let array = $.map(data, function (item) {
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

                    let terms = split( this.value );
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push( ui.item.value );
                    // add placeholder to get the comma-and-space at the end
                    terms.push( "" );

                    this.value = terms.join( ", " );

                    //récupère la valeur ville_id
                    let ville_id = ui.item.value.split('-')[0];

                    //cree in input hidden qui sera ajouter au form pour le submit
                    let input = '<input class="checkbox-custom" id="ville_id" name="ville[]" value="'+ ville_id+'" type="hidden">';

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

            //Slider
            $( function() {
                $('.slider').slider({
                    range: true,
                    animate: "fast",
                    min: <?php echo $minPrice; ?> ,
                    max: <?php echo $maxPrice; ?> ,
                    values: [ <?php echo request('price_min') ? request('price_min') : $minPrice; ?>, <?php echo request('price_max') ? request('price_max') : $maxPrice; ?> ],
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