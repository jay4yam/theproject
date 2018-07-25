@extends('layouts.back', [
                        'title' => 'Ajouter une nouvelle ville',
                        'seoCssActive' => 'active'
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
                            <h1 class="admin">Optimiser le seo</h1>
                        </div>
                        <div class="box-search-body text-left">
                            {{ Form::open(['route' => ['seo.store'], 'method' => 'POST', 'class' => 'createform']) }}
                            {{ Form::hidden('model_id', $model->id) }}
                            {{ Form::hidden('type', request('type')) }}
                            {{ Form::hidden('localize', App::getLocale()) }}
                            <div class="row">
                                <!-- 1ere col -->
                                <div class="col-md-6 col-xs-12">
                                    <!-- title -->
                                    <div class="form-group flex-column {!! $errors->has('title') ? 'has-error' : '' !!}">
                                        {{ Form::label('title', 'TITLE :') }}
                                        {{ Form::text('title', $model->title, ['class' => 'form-control']) }}
                                        {!! $errors->first('title', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <div class="form-group flex-column {!! $errors->has('meta_robots') ? 'has-error' : '' !!}">
                                        {{ Form::label('meta_robots', 'META ROBOTS :') }}
                                        {{ Form::select('meta_robots', config('meta_robots'), 'index-follow' ,['class' => 'form-control']) }}
                                        {!! $errors->first('meta_robots', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <div class="form-group flex-column {!! $errors->has('meta_description') ? 'has-error' : '' !!}">
                                        {{ Form::label('meta_description', 'META DESC :') }}
                                        {{ Form::text('meta_description', null, ['class' => 'form-control']) }}
                                        {!! $errors->first('meta_description', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <div class="form-group flex-column {!! $errors->has('canonical') ? 'has-error' : '' !!}">
                                        {{ Form::label('canonical', 'CANONICAL :') }}
                                        {{ Form::text('canonical', '/'.$model->locale.'/voyage/'.$model->id.'/'.str_slug($model->title), ['class' => 'form-control']) }}
                                        {!! $errors->first('canonical', '<small class="help-block">:message</small>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    Le seo c'est très important
                                </div>
                                <!-- Button submit-->
                                <div class="box-terms-bottom ptb-10">
                                    <button class="btn btn-success" type="submit">
                                        <i class="fas fa-save"></i>
                                        Optimiser le seo
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
@endsection