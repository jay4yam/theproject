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
                            <h1 class="admin">Créer une compagnie</h1>
                        </div>
                        <div class="box-search-body text-left">
                            {{ Form::open(['route' => [ 'compagny.store'] , 'class' => 'createform']) }}

                            <div class="form-group flex-column {!! $errors->has('raison_sociale') ? 'has-error' : '' !!}">
                                {{ Form::label('raison_sociale', 'RAISON SOCIALE :') }}
                                {{ Form::text('raison_sociale', null, ['class' => 'form-control']) }}
                                {!! $errors->first('raison_sociale', '<small class="help-block">:message</small>') !!}
                            </div>

                            <div class="form-group flex-column {!! $errors->has('adresse') ? 'has-error' : '' !!}">
                                {{ Form::label('adresse', 'ADRESSE :') }}
                                {{ Form::text('adresse', null, ['class' => 'form-control']) }}
                                {!! $errors->first('adresse', '<small class="help-block">:message</small>') !!}
                            </div>

                            <div class="form-group">
                                <div class="form-1-column  {!! $errors->has('code_postal') ? 'has-error' : '' !!}">
                                {{ Form::label('code_postal', 'CODE POSTAL :') }}
                                {{ Form::text('code_postal', null, ['class' => 'form-control']) }}
                                {!! $errors->first('code_postal', '<small class="help-block">:message</small>') !!}
                                </div>
                                <div class="form-2-column  {!! $errors->has('ville') ? 'has-error' : '' !!}">
                                {{ Form::label('ville', 'VILLE :') }}
                                {{ Form::text('ville', null, ['class' => 'form-control']) }}
                                {!! $errors->first('ville', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>

                            <div class="form-group ptb-10">
                                <div class="form-1-column  {!! $errors->has('telephone') ? 'has-error' : '' !!}">
                                    {{ Form::label('telephone', 'TELEPHONE :') }}
                                    {{ Form::text('telephone', null, ['class' => 'form-control']) }}
                                    {!! $errors->first('telephone', '<small class="help-block">:message</small>') !!}
                                </div>
                                <div class="form-2-column  {!! $errors->has('email') ? 'has-error' : '' !!}">
                                    {{ Form::label('email', 'EMAIL :') }}
                                    {{ Form::text('email', null, ['class' => 'form-control']) }}
                                    {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>

                            <div class="form-group ptb-10">
                                <div class="form-1-column  {!! $errors->has('mail_resa') ? 'has-error' : '' !!}">
                                    {{ Form::label('mail_resa', 'EMAIL UTILISE POUR LES RESERVATIONS :') }}
                                    {{ Form::text('mail_resa', null, ['class' => 'form-control']) }}
                                    {!! $errors->first('mail_resa', '<small class="help-block">:message</small>') !!}
                                </div>
                                <div class="form-2-column">
                                    <p class="marginAuto">C'est cette adresse e-mail qui sera toujours utilisée pour les réservations</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-1-column  {!! $errors->has('num_licence') ? 'has-error' : '' !!}">
                                    {{ Form::label('num_licence', 'NUMERO DE LICENCE :') }}
                                    {{ Form::text('num_licence', null, ['class' => 'form-control']) }}
                                    {!! $errors->first('num_licence', '<small class="help-block">:message</small>') !!}
                                </div>
                                <div class="form-2-column">
                                    <p class="marginAuto">
                                        Numéro de licence obligatoire, il sera vérifié par nos équipes.
                                    </p>
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
@endsection