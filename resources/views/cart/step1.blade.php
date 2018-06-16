@extends('layouts.other')

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
                        <div class="col-md-7">
                            <h5>Vos informations</h5>
                            <fieldset>
                                {{ Form::open() }}
                                <div class="form-group">
                                    <div>
                                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'nom']) }}
                                    </div>
                                    <div>
                                        {{ Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'prenom']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>
                                        {{ Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => 'telephone']) }}
                                    </div>
                                    <div>
                                        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'email']) }}
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </fieldset>
                        </div>
                        <div class="col-md-5">
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