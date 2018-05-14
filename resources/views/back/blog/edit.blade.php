@extends('layouts.back', [
                        'title' => 'Edition d\'article - Mettez à jour votre article du blog',
                        'blogCssActive' => 'active'
                        ])

@section('dedicated_css')
@endsection

@section('content')
    <!-- Destinations-->
    <section class="section-80 bg-wild-wand">
        <div class="container container-custom">
            <div class="row justify-content-sm-center">
                <div class="col-md-12 col-lg-12">
                    <!-- Box-->
                    <div class="box box-search bg-default d-block">
                        <div class="box-search-wrap">
                            <!-- RD Search Form-->
                            <h1 class="admin">Modifier - Mettre à jour un article
                                <a class="white" href="{{ route('blogs.create') }}" title="ajouter un article">
                                <span class="float-right">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                </a>
                            </h1>
                        </div>
                        <div class="box-search-body text-left">
                            {{ Form::model($article, ['route' => ['blogs.update', $article->id], 'files' => true, 'method' => 'PATCH', 'class' => 'createform']) }}
                            <div class="row">
                                <!-- 1ere col -->
                                <div class="col-md-8 col-xs-12">
                                    <!-- title -->
                                    <div class="form-group flex-column {!! $errors->has('title') ? 'has-error' : '' !!}">
                                        {{ Form::label('title', 'TITRE :') }}
                                        {{ Form::text('title', $article->title, ['class' => 'form-control']) }}
                                        {!! $errors->first('title', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <!-- slug -->
                                    <div class="form-group flex-column {!! $errors->has('slug') ? 'has-error' : '' !!}">
                                        {{ Form::label('slug', 'URL REWRITING :') }}
                                        {{ Form::text('slug', $article->slug, ['class' => 'form-control']) }}
                                        {!! $errors->first('slug', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <!-- intro -->
                                    <div class="form-group flex-column {!! $errors->has('intro') ? 'has-error' : '' !!}">
                                        {{ Form::label('intro', 'INTRO :') }}
                                        {{ Form::textarea('intro', $article->intro, ['class' => 'form-control']) }}
                                        {!! $errors->first('intro', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <!-- content -->
                                    <div class="form-group flex-column {!! $errors->has('contentArticle') ? 'has-error' : '' !!}">
                                        {{ Form::label('contentArticle', 'CONTENU :') }}
                                        {{ Form::textarea('contentArticle', $article->content, ['class' => 'form-control']) }}
                                        {!! $errors->first('contentArticle', '<small class="help-block">:message</small>') !!}
                                    </div>
                                </div>

                                <!-- 2eme col -->
                                <div class="col-md-4 col-xs-12">
                                    <!-- auteur -->
                                    <div class="form-group flex-column {!! $errors->has('user') ? 'has-error' : '' !!}">
                                        {{ Form::label('title', 'AUTEUR :') }}
                                        {{ Form::text('title', $article->user->profile->firstName, ['class' => 'form-control',  'disabled' => 'disabled']) }}
                                        {!! $errors->first('title', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <!-- main_image container -->
                                    <div class="image-container">
                                        <a href="#" class="roll" data-toggle="modal" data-target="#imageModal">
                                            <span>Modifier</span>
                                            <img src="/storage/blog/{{ $article->main_image }}" class="img-responsive"/>
                                        </a>
                                    </div>

                                    <!-- main_image upload -->
                                    <div class="form-group flex-column {!! $errors->has('main_image') ? 'has-error' : '' !!}">
                                        {{ Form::label('main_image', 'PHOTO PRINCIPALE :') }}
                                        {{ Form::file('main_image', ['class' => 'form-control',]) }}
                                        {!! $errors->first('main_image', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <!-- is_public -->
                                    <div class="form-group flex-column {!! $errors->has('is_public') ? 'has-error' : '' !!}">
                                        {{ Form::label('is_public', 'ARTICLE PUBLIC :', ['class' => 'switch']) }}
                                        {{ Form::select('is_public', [ true => 'public', false => 'privé'], $article->is_public, ['class' => 'form-control',]) }}
                                        {!! $errors->first('is_public', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <!-- categorie -->
                                    <div class="form-group flex-column {!! $errors->has('categorie') ? 'has-error' : '' !!}">
                                        {{ Form::label('categorie', 'CATEGORIES :', ['class' => 'switch']) }}
                                        <ul>
                                        @php $checked = ''; @endphp
                                        @foreach($allCats as $catId => $catName)
                                            @php
                                                $article->categories->each(function ($u) use(&$checked, $catName){
                                                if($catName == $u->title){
                                                    $checked = 'checked';

                                                    return $checked;
                                                }
                                                return $checked;
                                                });
                                            @endphp
                                            <li>{{ $catName }}
                                                <input @php echo $checked @endphp type="checkbox" name="categorie[]" value="{{ $catId }}" id="cat-{{ $catId }}" class="chk-cat">
                                            </li>
                                        @endforeach
                                        </ul>
                                    </div>

                                    <!-- Button submit-->
                                    <div class="box-terms-bottom ptb-10">
                                        <button class="btn btn-success" type="submit">
                                            <i class="fas fa-save"></i>
                                            Mettre a jour cet article
                                        </button>
                                    </div>
                                </div>
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
                    @php $img = \Image::make('storage/blog/'.$article->main_image); @endphp
                    <img src="/storage/blog/{{ $article->main_image }}" class="img-responsive">
                    <span class="img-size-info">
                        name: <strong>{{ $article->main_image }}</strong><br>
                        width: <strong>{{ @$img->width() }}.px</strong> |
                        height: <strong>{{ @$img->height() }}.px</strong> |
                        size: <strong>{{ round( (@$img->filesize() / 1000), 0, PHP_ROUND_HALF_UP) }}.ko </strong>
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