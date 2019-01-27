@extends('layouts.other', ['title' => 'Finaliser votre commande'])

@section('dedicated_css')
    <style>
        .StripeElement {
            background-color: white;
            height: 40px;
            padding: 10px 12px;
            border-radius: 4px;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@endsection

@section('content')

    <section class="section parallax-container bg-black section-height-mac context-dark" data-parallax-img="/images/vue-aerienne-panier-parallax.jpg">
        <div class="parallax-content">
            <div class="bg-overlay-darker">
                <div class="container cart-parallax">
                    <h1 class="d-none d-lg-inline-block">{{ __('panier.title') }}</h1>
                    <h6 class="font-italic">{{ __('panier.subtitle') }}!</h6>
                </div>
            </div>
        </div>
    </section>

    <section class="section-45 bg-wild-wand">
        <div class="container">
            <div class="box box-insets-off bg-default d-xl-block">
                <div class="recap-panier box-inner">
                    {{ Form::open(['route' => 'cart.charge', 'id' => 'payment-form']) }}
                    <div class="row">
                        <!-- Formulaire -->
                        <div class="col-md-6">
                            <h5>Vos informations</h5>
                            <fieldset>
                                <div class="form-inline">
                                    <div class="{!! $errors->has('name') ? 'has-error' : '' !!}">
                                    {{ Form::text('name', null, ['class' => 'form-control marginform', 'placeholder' => 'nom']) }}
                                    {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                                    </div>
                                    <div class="{!! $errors->has('firstname') ? 'has-error' : '' !!}">
                                    {{ Form::text('firstname', null, ['class' => 'form-control marginform', 'placeholder' => 'prenom']) }}
                                    {!! $errors->first('firstname', '<small class="help-block">:message</small>') !!}
                                    </div>
                                </div>
                                <div class="form-inline">
                                    <div class="{!! $errors->has('telephone') ? 'has-error' : '' !!}">
                                    {{ Form::text('telephone', null, ['class' => 'form-control marginform', 'placeholder' => 'telephone']) }}
                                    {!! $errors->first('telephone', '<small class="help-block">:message</small>') !!}
                                    </div>
                                    <div class="{!! $errors->has('email') ? 'has-error' : '' !!}">
                                    {{ Form::email('email', null, ['class' => 'form-control marginform', 'placeholder' => 'email']) }}
                                    {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                                    </div>
                                </div>
                                <div class="form-inline-item">
                                    <div class="{!! $errors->has('adresse') ? 'has-error' : '' !!}">
                                    {{ Form::text('adresse', null, ['class' => 'form-control marginform w95', 'placeholder' => 'Adresse']) }}
                                    {!! $errors->first('adresse', '<small class="help-block">:message</small>') !!}
                                    </div>
                                </div>
                                <div class="form-inline">
                                    <div class="{!! $errors->has('code_postal') ? 'has-error' : '' !!}">
                                    {{ Form::text('code_postal', null, ['class' => 'form-control marginform', 'placeholder' => 'Code postal']) }}
                                    {!! $errors->first('code_postal', '<small class="help-block">:message</small>') !!}
                                    </div>
                                    <div class="{!! $errors->has('ville') ? 'has-error' : '' !!}">
                                    {{ Form::text('ville', null, ['class' => 'form-control marginform', 'placeholder' => 'Ville']) }}
                                    {!! $errors->first('ville', '<small class="help-block">:message</small>') !!}
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <!-- Recap panier -->
                        <div class="col-md-6">
                            <h5>Vos vols ou voyages</h5>
                            <table id="carttable" class="table table-hover table-sm" style="text-align: center">
                                <thead class="thead-dark">
                                <tr>
                                    <th>voyage</th>
                                    <th>Nom</th>
                                    <th>Nb Voyageur</th>
                                    <th>Prix Unitaire</th>
                                    <th>Prix Final</th>
                                    <th>Supprimer</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $finalPrice = 0;
                                    $iterator = 1;
                                @endphp
                                @foreach(@$carts as $cle => $cart)
                                    <tr>
                                        <td><img src="/storage/voyages/thumbnails/{{ @$cart->getVoyage()->main_photo }}" width="50"></td>
                                        <td>
                                            {{ @$cart->getVoyage()->title }}<br>
                                            le {{ date( "d M Y", strtotime( $cart->getDate() ) ) }}
                                        </td>
                                        <td>{{ Form::number('',  @$cart->getNbVoyageur(), ['class' => 'updatevoyageur', 'data-target' => $cle] ) }}</td>
                                        <td id="individualPrice-{{$cle}}">{{ @$cart->getUnitPrice() }} €</td>
                                        <td id="finalPrice-{{$cle}}">{{ @$cart->getFinalPrice() }} €</td>
                                        <td data-target="">
                                            <a href="#" data-target="{{ $cle }}" class="deletefromcart">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @php
                                        $finalPrice += @$cart->getFinalPrice();
                                        $iterator++;
                                    @endphp
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2" style="text-align: right">Prix Total TTC</td>
                                    <td id="finalPrice"><b>{{ $finalPrice }} €</b></td>
                                    {{ Form::hidden('finalPrice', $finalPrice) }}
                                    <td></td>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="cart-form">
                                <div class="form-row">
                                    <label for="card-element">
                                        Credit or debit card
                                    </label>
                                    <div id="card-element" class="form-control">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                    <!-- Used to display Element errors. -->
                                    <div id="card-errors" role="alert"></div>
                                </div>
                            </div>
                            <div class="col-md-12 pt-10">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fab fa-cc-visa fa-2x"></i>
                                    </div>
                                    <div class="col-3">
                                        <i class="fab fa-cc-mastercard fa-2x"></i>
                                    </div>
                                    <div class="col-3">
                                        <i class="fab fa-cc-paypal fa-2x"></i>
                                    </div>
                                    <div class="col-3">
                                        <i class="far fa-lock fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-center pt-20">
                            {{ Form::button('Valider votre commande', ['type' => 'submit', 'class' => 'button button-primary']) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('images/100pour100-secure.png') }}" width="40%">
                            <p>Paiement 100% sécurisé</p>
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('images/site-de-confiance.png') }}" width="40%">
                            <p>Achat garanti</p>
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('images/site-prefere.png') }}" width="40%">
                            <p>100% satisfait</p>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>

@endsection

@section('dedicated_js')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        window.onload = function() {
            // Create a Stripe client.
            var stripe = Stripe('pk_test_q1LEmC3fnWZrAl79CsxAhzY3');

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {style: style});

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        };
    </script>
@endsection