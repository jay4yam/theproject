@extends('layouts.other', [
                            'title' => ' Connectez-vous à la plateforme easyCopter',
                            'activeLoginCss' => 'active'
                            ])

@section('content')

<!-- LOGIN -->
<div class="page text-center">
    <section class="section parallax-container bg-black" data-parallax-img="images/backgrounds/background-26-1920x900.jpg">
        <div class="parallax-content">
            <div class="container section-80 section-md-top-135 section-md-bottom-145">
                <div class="row justify-content-sm-center">
                    <div class="col-sm-9 col-md-7 col-lg-5 col-xl-4">
                        <!-- Box-->
                        <div class="box box-lg d-block bg-default inset-xl-left-60 inset-xl-right-60">
                            <h5 class="text-ubold text-md-left">Déjà inscrit</h5>
                            <form method="POST" action="{{ route('login') }}">
                                {{ Form::open(['route' => ['login']]) }}
                                <div class="form-wrap form-wrap-xs">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="votre email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-wrap form-wrap-xs form-offset-bottom-none">
                                    <input id="password" type="password" placeholder="mot de passe" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-wrap-checkbox">
                                    <div class="pull-sm-left">
                                        <p class="text-extra-small"><a class="text-primary" href="{{ route('password.request') }}">Mot de passe oublié</a></p>
                                    </div>
                                    <div class="pull-sm-right form-wrap">
                                        <label class="checkbox-inline checkbox-inline-right">
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="text-extra-small text-black inset-right-10">Se souvenir de moi</span>
                                        </label>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-button">
                                    <button class="button button-block button-icon button-icon-right button-primary" type="submit"><span>log in</span><span class="icon icon-xxs mdi mdi-chevron-right" style="float:none; margin-top: -1px;"></span></button>
                                </div>
                            {{ Form::close() }}
                            <p class="text-extra-small">Vous n'avez pas de compte ?<br> <a class="text-primary" href="{{ url('/register') }}">Créer un compte</a> Maintenant !</p>
                            <div class="section-hidden section-hidden-2">
                                <p class="divider-both-lines text-extra-small">Utilisez votre réseau social préféré</p>
                            </div>
                            <!-- List Inline-->
                            <ul class="list-inline list-inline-13">
                                <li class="text-center"><a class="icon icon-xxs icon-circle icon-circle-lg icon-filled-twitter fa fa-twitter text-white" href="#"></a></li>
                                <li class="text-center"><a class="icon icon-xxs icon-circle icon-circle-lg icon-filled-facebook fa fa-facebook text-white" href="#"></a></li>
                                <li class="text-center"><a class="icon icon-xxs icon-circle icon-circle-lg icon-filled-google-plus fa fa-google-plus text-white" href="#"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
