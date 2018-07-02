@extends('layouts.back', [
                        'title' => 'Edition la region',
                        'voyageCssActive' => 'active'
                        ])

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
                            <h1 class="admin">Modifier - Mettre à jour une région
                                <a class="white" href="{{ route('regions.create') }}" title="ajouter une région">
                                <span class="float-right">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                </a>
                            </h1>
                        </div>
                        <div class="box-search-body text-left">
                            {{ Form::model($region, ['route' => ['regions.update', $region->id], 'files' => true, 'method' => 'PATCH', 'class' => 'createform']) }}
                            <div class="row">
                                <!-- 1ere col -->
                                <div class="col-md-8 col-xs-12">
                                    <!-- title -->
                                    <div class="form-group flex-column {!! $errors->has('name') ? 'has-error' : '' !!}">
                                        {{ Form::label('name', 'NOM DE LA Region :') }}
                                        {{ Form::text('name', $region->name, ['class' => 'form-control']) }}
                                        {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <div class="form-group flex-column {!! $errors->has('title') ? 'has-error' : '' !!}">
                                        {{ Form::label('title', 'TITRE :') }}
                                        {{ Form::text('title', $region->title, ['class' => 'form-control']) }}
                                        {!! $errors->first('title', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <div class="form-group flex-column {!! $errors->has('subtitle') ? 'has-error' : '' !!}">
                                        {{ Form::label('subtitle', 'SOUS-TITRE :') }}
                                        {{ Form::text('subtitle', $region->subtitle, ['class' => 'form-control']) }}
                                        {!! $errors->first('subtitle', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <div class="form-group flex-column {!! $errors->has('description') ? 'has-error' : '' !!}">
                                        {{ Form::label('description', 'DESCRIPTION :') }}
                                        {{ Form::textarea('description', $region->description, ['class' => 'form-control']) }}
                                        {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
                                    </div>
                                </div>

                                <!-- 2eme col -->
                                <div class="col-md-4 col-xs-12">
                                    <!-- main_image container -->
                                    <div class="image-container">
                                        <a href="#" class="roll" data-toggle="modal" data-target="#imageModal">
                                            <span>Modifier</span>
                                            <img src="/storage/{{ $region->main_photo }}" class="img-responsive"/>
                                        </a>
                                    </div>

                                    <!-- main_image upload -->
                                    <div class="form-group flex-column {!! $errors->has('main_photo') ? 'has-error' : '' !!}">
                                        {{ Form::label('main_photo', 'PHOTO PRINCIPALE :') }}
                                        {{ Form::file('main_photo', ['class' => 'form-control',]) }}
                                        {!! $errors->first('main_photo', '<small class="help-block">:message</small>') !!}
                                    </div>

                                </div>

                                <!-- Button submit-->
                                <div class="box-terms-bottom ptb-10">
                                    <button class="btn btn-success" type="submit">
                                        <i class="fas fa-save"></i>
                                        Mettre a jour cette région
                                    </button>
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
                    @php $img = \Image::make('storage/'.$region->main_photo); @endphp
                    <img src="/storage/{{ $region->main_photo }}" class="img-responsive">
                    <span class="img-size-info">
                        name: <strong>{{ $region->main_photo }}</strong><br>
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

        });
    </script>
@endsection