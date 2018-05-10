@extends('layouts.back', ['title' => 'Editer le profil de l\'utilisateur'])

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
                            <h1 class="admin">Editez le profil de l'utilisateur</h1>
                        </div>
                        <div class="box-search-body text-left">
                            {{ Form::model($user, ['route' => ['users.update', $user->id], 'files' => true, 'method' => 'PATCH', 'class' => 'createform']) }}

                            <div class="form-group flex-column {!! $errors->has('email') ? 'has-error' : '' !!}">
                                {{ Form::label('email', 'E-MAIL :') }}
                                {{ Form::text('email', $user->email, ['class' => 'form-control']) }}
                                {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                            </div>

                            <div class="form-group flex-column {!! $errors->has('role') ? 'has-error' : '' !!}">
                                {{ Form::label('role', 'ROLE :') }}
                                {{ Form::select('role', ['admin' => 'admin', 'pro' => 'pro', 'guest' => 'guest'], $user->role, ['placeholder' => 'Selectionner le role de l\'utilisateur', 'class' => 'form-control']) }}
                                {!! $errors->first('role', '<small class="help-block">:message</small>') !!}
                            </div>

                            @include('partials._compagnies_select', ['user' => $user])

                            <div class="form-group">
                                <div class="form-1-column  flex-column {!! $errors->has('firstName') ? 'has-error' : '' !!}">
                                    {{ Form::label('firstName', 'PRENOM :') }}
                                    {{ Form::text('firstName', @$user->profile->firstName, ['class' => 'form-control']) }}
                                    {!! $errors->first('firstName', '<small class="help-block">:message</small>') !!}
                                </div>

                                <div class="form-2-column  flex-column {!! $errors->has('fullName') ? 'has-error' : '' !!}">
                                    {{ Form::label('fullName', 'NOM :') }}
                                    {{ Form::text('fullName', @$user->profile->fullName,['class' => 'form-control']) }}
                                    {!! $errors->first('fullName', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-1-column  flex-column {!! $errors->has('birthDate') ? 'has-error' : '' !!}">
                                    {{ Form::label('birthDate', 'DATE DE NAISSANCE :') }}
                                    {{ Form::date('birthDate', @$user->profile->birthDate, ['class' => 'form-control']) }}
                                    {!! $errors->first('birthDate', '<small class="help-block">:message</small>') !!}
                                </div>

                                <div class="form-2-column  flex-column {!! $errors->has('phoneNumber') ? 'has-error' : '' !!}">
                                    {{ Form::label('phoneNumber', 'TELEPHONE :') }}
                                    {{ Form::text('phoneNumber', @$user->profile->phoneNumber,['class' => 'form-control']) }}
                                    {!! $errors->first('phoneNumber', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-1-column  flex-column {!! $errors->has('address') ? 'has-error' : '' !!}">
                                    {{ Form::label('address', 'ADRESSE :') }}
                                    {{ Form::text('address', @$user->profile->address, ['class' => 'form-control']) }}
                                    {!! $errors->first('address', '<small class="help-block">:message</small>') !!}
                                </div>

                                <div class="form-2-column  flex-column {!! $errors->has('country') ? 'has-error' : '' !!}">
                                    {{ Form::label('country', 'PAYS :') }}
                                    {{ Form::text('country', @$user->profile->country,['class' => 'form-control']) }}
                                    {!! $errors->first('country', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-1-column  flex-column {!! $errors->has('postalCode') ? 'has-error' : '' !!}">
                                    {{ Form::label('postalCode', 'CODE POSTAL :') }}
                                    {{ Form::text('postalCode', @$user->profile->postalCode, ['class' => 'form-control']) }}
                                    {!! $errors->first('postalCode', '<small class="help-block">:message</small>') !!}
                                </div>

                                <div class="form-2-column  flex-column {!! $errors->has('city') ? 'has-error' : '' !!}">
                                    {{ Form::label('city', 'VILLE :') }}
                                    {{ Form::text('city', @$user->profile->city,['class' => 'form-control']) }}
                                    {!! $errors->first('city', '<small class="help-block">:message</small>') !!}
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

@section('dedicated_js')
    <script>
        $(document).ready(function () {

            //Affiche le mot de passe en clair ou pas
            $('#seeThePass').on('click', function () {
                if( $('#password').attr('type') === 'password')
                    $('#password').attr({'type':'text'});
                else{
                    $('#password').attr({'type':'password'});
                }
            });

            //Affiche la liste des compagnies si l'utilisateur est 'Pro'
                var content = $('#role :selected').val();
                if( content === 'pro'){
                    $('#compagnies_bloc').show();
                }
                else{
                    $('#compagnies_bloc').hide();
                }
        });
    </script>
@endsection