@extends('layouts.back', [
                            'title' => 'Créer un nouveau voyage',
                            'voyageCssActive' => 'active'
                          ])

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
                            <h1 class="admin">Créer un nouveau voyage</h1>
                        </div>
                        <div class="box-search-body text-left">
                                {{ Form::open(['route' => ['voyages.store'] , 'files' => true, 'method' => 'POST', 'class' => 'createform']) }}
                                {{ Form::hidden('localize', App::getLocale()) }}
                                <div class="row">
                                    <!-- 1ere col -->
                                    <div class="col-md-8">
                                        <div class="form-group flex-column {!! $errors->has('title') ? 'has-error' : '' !!}">
                                            {{ Form::label('title', 'TITLE :') }}
                                            {{ Form::text('title', null, ['class' => 'form-control', 'value' =>  old('title')]) }}
                                            {!! $errors->first('title', '<small class="help-block">:message</small>') !!}
                                        </div>

                                        <div class="form-group flex-column {!! $errors->has('subtitle') ? 'has-error' : '' !!}">
                                            {{ Form::label('subtitle', 'SUBTITLE :') }}
                                            {{ Form::text('subtitle', null, ['value' => old('subtitle'), 'class' => 'form-control']) }}
                                            {!! $errors->first('subtitle', '<small class="help-block">:message</small>') !!}
                                        </div>

                                        <div class="form-group flex-column {!! $errors->has('intro') ? 'has-error' : '' !!}">
                                            {{ Form::label('intro', 'INTRO :') }}
                                            {{ Form::textarea('intro',  null, ['value' => old('intro'), 'placeholder' => 'Selectionner le role de l\'utilisateur', 'class' => 'form-control']) }}
                                            {!! $errors->first('intro', '<small class="help-block">:message</small>') !!}
                                        </div>

                                        <div class="form-group flex-column {!! $errors->has('description') ? 'has-error' : '' !!}">
                                            {{ Form::label('description', 'DESCRIPTION :') }}
                                            {{ Form::textarea('description',  null, ['value' => old('description'), 'class' => 'form-control']) }}
                                            {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
                                        </div>
                                    </div>
                                    <!-- 2eme col -->
                                    <div class="col-md-4">
                                        <div class="form-group flex-column {!! $errors->has('is_public') ? 'has-error' : '' !!}">
                                            {{ Form::label('is_public', 'EST VISIBLE :') }}
                                            {{ Form::select('is_public', [false => 'non', true => 'oui'], '' ,['value' => old('is_public'),'class' => 'form-control', 'placeholder' => 'Sélection de la visibilité']) }}
                                            {!! $errors->first('is_public', '<small class="help-block">:message</small>') !!}
                                        </div>

                                        <div class="form-group flex-column {!! $errors->has('price') ? 'has-error' : '' !!}">
                                            {{ Form::label('price', 'PRICE :') }}
                                            {{ Form::text('price', null, ['value'=> old('price'), 'class' => 'form-control']) }}
                                            {!! $errors->first('price', '<small class="help-block">:message</small>') !!}
                                        </div>

                                        <div class="form-group flex-column {!! $errors->has('is_discounted') ? 'has-error' : '' !!}">
                                            {{ Form::label('is_discounted', 'REMISE :') }}
                                            {{ Form::select('is_discounted', [false => 'non', true => 'oui'], '',['value'=> old('is_discounted'), 'class' => 'form-control', 'placeholder' => 'Prix est il remisé']) }}
                                            {!! $errors->first('is_discounted', '<small class="help-block">:message</small>') !!}
                                        </div>

                                        <div class="form-group flex-column {!! $errors->has('discount_price') ? 'has-error' : '' !!}">
                                            {{ Form::label('discount_price', 'PRIX AVEC REMISE :') }}
                                            {{ Form::text('discount_price', null ,['value'=> old('discount_price'), 'class' => 'form-control',]) }}
                                            {!! $errors->first('discount_price', '<small class="help-block">:message</small>') !!}
                                        </div>

                                        <!-- main_image container -->
                                        <div class="image-container">
                                            <a href="#" class="roll" data-toggle="modal" data-target="#imageModal">
                                                <span>Modifier</span>
                                                <img src="/storage/voyages/" class="img-responsive"/>
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
                                            {{ Form::text('duree_du_vol', null, [ 'value'=> old('duree_du_vol'), 'class' => 'form-control']) }}
                                            {!! $errors->first('duree_du_vol', '<small class="help-block">:message</small>') !!}
                                        </div>

                                        <div class="form-group flex-column {!! $errors->has('ville_id') ? 'has-error' : '' !!}">
                                            {{ Form::label('ville_id', 'VILLE :') }}
                                            {{ Form::select('ville_id', \App\Models\Ville::pluck('name', 'id'), '' ,['value'=> old('ville_id') , 'class' => 'form-control', 'placeholder' => 'Sélection de la ville']) }}
                                            {!! $errors->first('ville_id', '<small class="help-block">:message</small>') !!}
                                        </div>

                                        <div class="form-group flex-column {!! $errors->has('compagny_id') ? 'has-error' : '' !!}">
                                            {{ Form::label('compagny_id', 'COMPAGNIE :') }}
                                            {{ Form::select('compagny_id', \App\Models\Compagnie::pluck('raison_sociale','id'), '' ,['value'=> old('compagny_id') , 'class' => 'form-control', 'placeholder' => 'Sélection de la compagnie']) }}
                                            {!! $errors->first('compagny_id', '<small class="help-block">:message</small>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group align-center pt-45">
                                    <button class="button button-primary" title="enregistrer" type="submit">
                                        Enregistrer
                                    </button>
                                </div>
                                {{ Form::close() }}
                            <blockquote class="create-lang">
                                Lors de l'enregistrement de ce voyage dans sa version {{ App::getLocale() }}, le système va créer autant de copies de ce voyage qu'il y a de langues disponibles  :
                                <ol>
                                    @php
                                        $langArray = Config::get('language');
                                        unset($langArray[App::getLocale()]);
                                    @endphp
                                    @foreach($langArray as $cle => $value)
                                        <li>{{ $cle }}</li>
                                    @endforeach
                                </ol>
                                Les copies ne seront pas visibles dans le front office, l'attribut "est visible" de ces copies aura la valeur "non"
                            </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('dedicated_js')
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