@extends('layouts.back', [
                            'title' => 'Editer le voyage',
                            'voyageCssActive' => 'active'
                          ])
@section('dedicated_css')
    <link rel="stylesheet" href="{{ asset('/css/dropzone.css') }}">
@endsection

@section('content')
    <!-- Destinations-->
    <section class="section-80 bg-wild-wand">
        <div class="container container-custom">
            <div class="row justify-content-sm-center">
                <div class="col-md-10 col-lg-12">
                    <!-- Box-->
                    <div class="box box-search bg-default d-block">
                        <div class="box-search-wrap">
                            <!-- RD Search Form-->
                            <h1 class="admin">Editez le voyage</h1>
                        </div>
                        <div class="box-search-body text-left">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @php $i = 1; @endphp
                                @foreach(Config::get('language') as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $i == 1 ? 'active' : '' }}" id="{{ $lang }}-tab" data-toggle="tab" href="#{{ $lang }}" role="tab" aria-controls="home" aria-selected="true">{{ $lang }}</a>
                                    </li>
                                    @php $i ++; @endphp
                                @endforeach
                            </ul>
                            <div class="tab-content padding-top-20" id="myTabContent">
                                @php $j = 1; $original_voyage_id = 0; @endphp
                                @foreach(Config::get('language') as $cleLang => $lang)
                                    @php
                                        if(!array_key_exists($cleLang, $voyages))
                                        {
                                            $voyages[$cleLang] = new \App\Models\Voyage();
                                        }
                                        $voyage = $voyages[$cleLang];
                                    @endphp
                                    <div class="tab-pane fade {{ $j == 1 ? 'show active' : '' }}" id="{{ $lang }}" role="tabpanel" aria-labelledby="{{ $lang }}-tab">
                                        {{ Form::model($voyage,['route' => ['voyages.update', $voyage->id], 'files' => true, 'method' => 'PATCH', 'class' => 'createform']) }}
                                            {{ Form::hidden('localize', $cleLang) }}
                                            {{ Form::hidden('parent_id', $voyage->parent_id) }}
                                        <div class="row">
                                            <!-- 1ere col -->
                                            <div class="col-md-8">
                                                <div class="form-group flex-column {!! $errors->has('title') ? 'has-error' : '' !!}">
                                                {{ Form::label('title', 'TITLE :') }}
                                                {{ Form::text('title', $voyage->title, ['class' => 'form-control']) }}
                                                {!! $errors->first('title', '<small class="help-block">:message</small>') !!}
                                                </div>

                                                <div class="form-group flex-column {!! $errors->has('subtitle') ? 'has-error' : '' !!}">
                                                {{ Form::label('subtitle', 'SUBTITLE :') }}
                                                {{ Form::text('subtitle', $voyage->subtitle, ['class' => 'form-control']) }}
                                                {!! $errors->first('subtitle', '<small class="help-block">:message</small>') !!}
                                                </div>

                                                <div class="form-group flex-column {!! $errors->has('intro') ? 'has-error' : '' !!}">
                                                {{ Form::label('intro', 'INTRO :') }}
                                                {{ Form::textarea('intro',  $voyage->intro, ['placeholder' => 'Selectionner le role de l\'utilisateur', 'class' => 'form-control']) }}
                                                {!! $errors->first('intro', '<small class="help-block">:message</small>') !!}
                                                </div>

                                                <div class="form-group flex-column {!! $errors->has('description') ? 'has-error' : '' !!}">
                                                {{ Form::label('description', 'DESCRIPTION :') }}
                                                {{ Form::textarea('description',  $voyage->description, ['class' => 'form-control']) }}
                                                {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
                                                </div>
                                            </div>
                                            <!-- 2eme col -->
                                            <div class="col-md-4">
                                                <div class="form-group flex-column {!! $errors->has('is_public') ? 'has-error' : '' !!}">
                                                    {{ Form::label('is_public', 'EST VISIBLE :') }}
                                                    {{ Form::select('is_public', [false => 'non', true => 'oui'], $voyage->is_public ,['class' => 'form-control',]) }}
                                                    {!! $errors->first('is_public', '<small class="help-block">:message</small>') !!}
                                                </div>
                                                <div class="form-group flex-column {!! $errors->has('price') ? 'has-error' : '' !!}">
                                                    {{ Form::label('price', 'PRICE :') }}
                                                    {{ Form::text('price', $voyage->price, ['class' => 'form-control']) }}
                                                    {!! $errors->first('price', '<small class="help-block">:message</small>') !!}
                                                </div>

                                                <div class="form-group flex-column {!! $errors->has('is_discounted') ? 'has-error' : '' !!}">
                                                    {{ Form::label('is_discounted', 'REMISE :') }}
                                                    {{ Form::select('is_discounted', [false => 'non', true => 'oui'], $voyage->is_discounted ,['class' => 'form-control',]) }}
                                                    {!! $errors->first('is_discounted', '<small class="help-block">:message</small>') !!}
                                                </div>
                                                <div class="form-group flex-column {!! $errors->has('discount_price') ? 'has-error' : '' !!}">
                                                    {{ Form::label('discount_price', 'PRIX AVEC REMISE :') }}
                                                    {{ Form::text('discount_price', $voyage->discount_price ,['class' => 'form-control',]) }}
                                                    {!! $errors->first('discount_price', '<small class="help-block">:message</small>') !!}
                                                </div>


                                                <!-- main_image container -->
                                                <div class="image-container">
                                                    <a href="#" class="roll" data-toggle="modal" data-target="#imageModal">
                                                        <span>Modifier</span>
                                                        <img src="/storage/voyages/{{ $voyage->main_photo }}" class="img-responsive"/>
                                                    </a>
                                                </div>

                                                <!-- main_image upload -->
                                                <div class="form-group flex-column {!! $errors->has('main_photo') ? 'has-error' : '' !!}">
                                                    {{ Form::label('main_photo', 'PHOTO PRINCIPALE :') }}
                                                    {{ Form::file('main_photo', ['class' => 'form-control',]) }}
                                                    {!! $errors->first('main_photo', '<small class="help-block">:message</small>') !!}
                                                </div>

                                                <div class="form-group flex-column {!! $errors->has('duree_du_vol') ? 'has-error' : '' !!}">
                                                    {{ Form::label('duree_du_vol', 'DUREE DU VOL (en minutes) :') }}
                                                    {{ Form::text('duree_du_vol', $voyage->duree_du_vol, ['class' => 'form-control']) }}
                                                    {!! $errors->first('duree_du_vol', '<small class="help-block">:message</small>') !!}
                                                </div>

                                                <div class="form-group flex-column {!! $errors->has('ville_id') ? 'has-error' : '' !!}">
                                                    {{ Form::label('ville_id', 'VILLE :') }}
                                                    {{ Form::select('ville_id', \App\Models\Ville::pluck('name', 'id'), @$voyage->ville->id ,['class' => 'form-control', 'placeholder' => 'Sélection de la ville']) }}
                                                    {!! $errors->first('ville_id', '<small class="help-block">:message</small>') !!}
                                                </div>
                                                <div class="form-group flex-column {!! $errors->has('compagny_id') ? 'has-error' : '' !!}">
                                                    {{ Form::label('compagny_id', 'COMPAGNIE :') }}
                                                    {{ Form::select('compagny_id', \App\Models\Compagnie::pluck('raison_sociale','id'),
                                                                                    @$voyage->compagnies(['id'])->first()->id,
                                                                                    ['value'=> old('compagny_id') ,
                                                                                    'class' => 'form-control',
                                                                                    'placeholder' => 'Sélection de la compagnie']) }}
                                                    {!! $errors->first('compagny_id', '<small class="help-block">:message</small>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group align-center pt-45">
                                            <button class="button button-primary" title="enregistrer" type="submit">
                                                Enregistrer la version {{ $cleLang }}
                                            </button>
                                        </div>
                                        {{ Form::close() }}

                                    <!-- DROPzone.js-->
                                        <div class="row">
                                            <h5 class="h5-slider">Photos du Slider</h5>
                                            <div class="col-md-6">
                                                {{ Form::open(['route' => 'voyages.upload.miniature', 'class'=>'dropzone']) }}
                                                {{ Form::hidden('voyage_id', $voyage->id) }}
                                                {{ Form::close() }}
                                            </div>
                                            <div class="col-md-6">
                                                @if(is_dir('storage/voyages/'.$voyage->id.'/min'))
                                                    @foreach(File::allFiles('storage/voyages/'.$voyage->id.'/min') as $file)
                                                        <div class="img-min">
                                                            <a href="#" class="delete-img" data-target="/voyages/{{ $voyage->id }}/min/{{ $file->getFilename() }}">x remove</a>
                                                            <img src="/storage/voyages/{{ $voyage->id }}/min/{{ $file->getFilename() }}" class="img-responsive" width="100px">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @php $j ++; @endphp
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Modal -->

@endsection

@section('dedicated_js')
    <script src="{{ asset('/js/dropzone.js') }}"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=bc7n096vwltba48ltvrnae4ya1bijl4g9yduphn5lp9kl2o9"></script>
    <script>
        $(document).ready(function (){
            tinymce.init({
                selector: 'textarea',
                height: 200,
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor textcolor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste code help wordcount'
                ],
                toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tinymce.com/css/codepen.min.css']
            });

            //lors du changement de la valeur de 'title' on slugify le nouveau 'title' et met à jour l'input slug
            $('#title').on('change', function () {
                var title  = $(this).val();

                var slug = slugify(title);

                $('#slug').val(slug);
            });

            //Supression d'une image du slider
            var removeImageSlider = $('.delete-img');
            removeImageSlider.on('click', function (e) {
                //recupere l'objet clicker
                var that = $(this);
                //supprime l'effet du lien
                e.preventDefault();
                //affiche un message de confirmation avant suppression
                var confirmation = confirm('Voulez vous vraiment supprimer cette image ?');
                //si confirmation OK
                if(confirmation) {
                    //recupere le fichier à supprimer
                    var data = removeImageSlider.data('target');
                    //effectue une requete ajax pour supression
                    $.ajax({
                        type: 'get',
                        url: "/fr/admin/delete-miniature",
                        data: {file: data},
                        success: function (event, data) {
                            //si la suppression est un succès on supprime l'image et son div parent
                            var div = that.parent('div');
                            div.hide();
                        }
                    });
                }
            })
        });

        function slugify(str) {
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
            var to   = "aaaaeeeeiiiioooouuuunc------";
            for (var i=0, l=from.length ; i<l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes

            return str;
        }
    </script>
@endsection