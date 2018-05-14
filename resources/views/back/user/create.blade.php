@extends('layouts.back', [
                            'title' => 'Créer un nouvel utilisateur',
                            'userCssActive' => 'active'
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
                            <h1 class="admin">Créer un utilisateur</h1>
                        </div>
                        <div class="box-search-body text-left">
                            {{ Form::open(['route' => [ 'users.store'] , 'class' => 'createform']) }}

                            <div class="form-group">
                                <div class="form-1-column  flex-column {!! $errors->has('email') ? 'has-error' : '' !!}">
                                    {{ Form::label('email', 'E-MAIL :') }}
                                    {{ Form::text('email', null, ['class' => 'form-control']) }}
                                    {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                                </div>

                                <div class="form-2-column  flex-column {!! $errors->has('password') ? 'has-error' : '' !!}">
                                    {{ Form::label('password', 'MOT DE PASSE :') }}
                                    {{ Form::password('password', ['class' => 'form-control']) }}
                                    {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
                                    <div class="">
                                        <small>Voir le mot de passe en clair</small>
                                        {{ Form::checkbox('seeThePass', 0, false, ['id' => 'seeThePass']) }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group flex-column {!! $errors->has('role') ? 'has-error' : '' !!}">
                                {{ Form::label('role', 'ROLE :') }}
                                {{ Form::select('role', ['admin' => 'admin', 'pro' => 'pro', 'guest' => 'guest'], null, ['placeholder' => 'Selectionner le role de l\'utilisateur', 'class' => 'form-control']) }}
                                {!! $errors->first('role', '<small class="help-block">:message</small>') !!}
                            </div>

                            @include('partials._compagnies_select')

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
            $('#role').on('change', function () {
                var content = $('#role :selected').val();
                console.log(content);
                if( content === 'pro'){
                    $('#compagnies_bloc').show();
                }
                else{
                    $('#compagnies_bloc').hide();
                }
            });
        });
    </script>
@endsection