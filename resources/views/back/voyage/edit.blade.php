@extends('layouts.back', [
                            'title' => 'Editer le voyage',
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
                            <h1 class="admin">Editez le voyage</h1>
                        </div>
                        <div class="box-search-body text-left">
                            {{ Form::model($voyage, ['route' => ['voyages.update', $voyage->id], 'files' => true, 'method' => 'PATCH', 'class' => 'createform']) }}
                            <div class="row">
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
                                        {{ Form::select('ville_id', \App\Models\Ville::pluck('name', 'id'), $voyage->ville->id ,['class' => 'form-control',]) }}
                                        {!! $errors->first('ville_id', '<small class="help-block">:message</small>') !!}
                                    </div>

                                </div>
                            </div>

                            <div class="form-group align-center pt-45">
                                <button class="button button-primary" title="enregistrer" type="submit">
                                    Enregistrer
                                </button>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modificateur d'image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @php //$img = \Image::make('storage/voyages/'.$voyage->main_photo); @endphp
                    <img src="/storage/voyages/{{ $voyage->main_photo }}" class="img-responsive">
                    <span class="img-size-info">
                        name: <strong>{{ $voyage->main_photo }}</strong><br>
                        width: <strong>@{{ @$img->width() }}.px</strong> |
                        height: <strong>@{{ @$img->height() }}.px</strong> |
                        size: <strong>@{{ round( (@$img->filesize() / 1000), 0, PHP_ROUND_HALF_UP) }}.ko </strong>
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
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