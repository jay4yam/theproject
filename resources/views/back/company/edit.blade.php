@extends('layouts.back')

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
                            <h1 class="admin">Finalisez l'insertion</h1>
                        </div>
                        <div class="box-search-body text-left">

                            {{ Form::model($compagnie, ['route' => ['compagny.update', $compagnie->id], 'files' => true, 'method' => 'PATCH', 'class' => 'createform']) }}
                            <div class="row">
                                <div class="col-md-6">

                                <div class="form-group {!! $errors->has('raison_sociale') ? 'has-error' : '' !!}">
                                {{ Form::label('raison_sociale', 'RAISON SOCIALE :') }}
                                {{ Form::text('raison_sociale', $compagnie->raison_sociale, ['class' => 'form-control']) }}
                                {!! $errors->first('raison_sociale', '<small class="help-block">:message</small>') !!}
                            </div>

                                <div class="form-group {!! $errors->has('adresse') ? 'has-error' : '' !!}">
                                {{ Form::label('adresse', 'ADRESSE :') }}
                                {{ Form::text('adresse', $compagnie->adresse, ['class' => 'form-control']) }}
                                {!! $errors->first('adresse', '<small class="help-block">:message</small>') !!}
                            </div>

                                <div class="form-group">
                                <div class="form-1-column  {!! $errors->has('code_postal') ? 'has-error' : '' !!}">
                                    {{ Form::label('code_postal', 'CODE POSTAL :') }}
                                    {{ Form::text('code_postal', $compagnie->code_postal, ['class' => 'form-control']) }}
                                    {!! $errors->first('code_postal', '<small class="help-block">:message</small>') !!}
                                </div>
                                <div class="form-2-column  {!! $errors->has('ville') ? 'has-error' : '' !!}">
                                    {{ Form::label('ville', 'VILLE :') }}
                                    {{ Form::text('ville', $compagnie->ville, ['class' => 'form-control']) }}
                                    {!! $errors->first('ville', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>
                                <div class="clearfix"></div>

                                <div class="form-group ptb-10">
                                <div class="form-1-column  {!! $errors->has('telephone') ? 'has-error' : '' !!}">
                                    {{ Form::label('telephone', 'TELEPHONE :') }}
                                    {{ Form::text('telephone', $compagnie->telephone, ['class' => 'form-control']) }}
                                    {!! $errors->first('telephone', '<small class="help-block">:message</small>') !!}
                                </div>
                                <div class="form-2-column  {!! $errors->has('email') ? 'has-error' : '' !!}">
                                    {{ Form::label('email', 'EMAIL :') }}
                                    {{ Form::text('email', $compagnie->email, ['class' => 'form-control']) }}
                                    {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>
                                <div class="clearfix"></div>

                                <div class="form-group ptb-10">
                                <div class="form-1-column  {!! $errors->has('mail_resa') ? 'has-error' : '' !!}">
                                    {{ Form::label('mail_resa', 'EMAIL UTILISE POUR LES RESERVATIONS :') }}
                                    {{ Form::text('mail_resa', $compagnie->mail_resa, ['class' => 'form-control']) }}
                                    {!! $errors->first('mail_resa', '<small class="help-block">:message</small>') !!}
                                </div>
                                <div class="form-2-column">
                                    <p class="pt-45">C'est cette adresse e-mail qui sera toujours utilisée pour les réservations</p>
                                </div>
                            </div>
                                <div class="clearfix"></div>

                                <div class="form-group">
                                <div class="form-1-column  {!! $errors->has('num_licence') ? 'has-error' : '' !!}">
                                    {{ Form::label('num_licence', 'NUMERO DE LICENCE :') }}
                                    {{ Form::text('num_licence', $compagnie->num_licence, ['class' => 'form-control']) }}
                                    {!! $errors->first('num_licence', '<small class="help-block">:message</small>') !!}
                                </div>
                                <div class="form-2-column">
                                    <p class="pt-45">
                                        Numéro de licence obligatoire, il sera vérifié par nos équipes.
                                    </p>
                                </div>
                            </div>
                                <div class="clearfix"></div>

                            </div>

                                <div class="col-md-6">
                                    <div class="form-group {!! $errors->has('baseline') ? 'has-error' : '' !!}">
                                        {{ Form::label('baseline', 'BASELINE  :') }}
                                        {{ Form::text('baseline', $compagnie->baseline, ['class' => 'form-control']) }}
                                        {!! $errors->first('baseline', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <div class="form-group {!! $errors->has('intro') ? 'has-error' : '' !!}">
                                        {{ Form::label('intro', 'INTRO  :') }}
                                        {{ Form::text('intro', $compagnie->intro, ['class' => 'form-control']) }}
                                        {!! $errors->first('intro', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <div class="form-group {!! $errors->has('presentation') ? 'has-error' : '' !!}">
                                        {{ Form::label('presentation', 'PRESENTATION  :') }}
                                        {{ Form::textarea('presentation', $compagnie->presentation, ['class' => 'form-control']) }}
                                        {!! $errors->first('presentation', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <div class="form-group {!! $errors->has('logo') ? 'has-error' : '' !!}">
                                        {{ Form::label('logo', 'LOGO  :') }}
                                        {{ Form::file('logo', ['class' => 'form-control']) }}
                                        {!! $errors->first('logo', '<small class="help-block">:message</small>') !!}
                                    </div>

                                    <div class="form-group {!! $errors->has('logo') ? 'has-error' : '' !!}">
                                        {{ Form::label('background_image', 'ARRIERE PLAN :') }}
                                        {{ Form::file('background_image', ['class' => 'form-control']) }}
                                        {!! $errors->first('background_image', '<small class="help-block">:message</small>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center pt-45">
                                <button class="button button-primary" title="enregistrer" type="submit">
                                    Finalisez l'inscription
                                </button>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection