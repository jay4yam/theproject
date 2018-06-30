@extends('layouts.other', ['title' => 'Finaliser votre commande'])

@section('content')
    <!--
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
    -->
    <section class="section-80 bg-wild-wand">
        <div class="container">
            <div class="box box-insets-off bg-default d-xl-block">
                <div class="recap-panier box-inner">
                    <div class="row">
                        <!-- Formulaire -->
                        <div class="col-md-6">
                            <h5>Vos informations</h5>
                            <fieldset>
                                {{ Form::open() }}

                                <div class="form-inline">
                                    {{ Form::text('name', null, ['class' => 'form-control marginform', 'placeholder' => 'nom']) }}
                                    {{ Form::text('firstname', null, ['class' => 'form-control marginform', 'placeholder' => 'prenom']) }}
                                </div>
                                <div class="form-inline">
                                    {{ Form::text('telephone', null, ['class' => 'form-control marginform', 'placeholder' => 'telephone']) }}
                                    {{ Form::email('email', null, ['class' => 'form-control marginform', 'placeholder' => 'email']) }}
                                </div>
                                <div class="form-inline-item">
                                    {{ Form::text('adresse', null, ['class' => 'form-control marginform w97', 'placeholder' => 'Adresse']) }}
                                </div>
                                <div class="form-inline">
                                    {{ Form::text('code_postal', null, ['class' => 'form-control marginform', 'placeholder' => 'Code postal']) }}
                                    {{ Form::text('ville', null, ['class' => 'form-control marginform', 'placeholder' => 'Ville']) }}
                                </div>
                                <div class="col-xs-12">
                                    {{ Form::button('Valider votre commande', ['type' => 'submit', 'class' => 'btn btn-success']) }}
                                </div>
                                {{ Form::close() }}
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
                                            {{ @$cart->getDate() }}
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
                                    <td></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection