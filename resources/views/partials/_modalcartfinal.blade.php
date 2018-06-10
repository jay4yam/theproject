<!-- Modal cart -->
@php
    $carts = [];
@endphp
@if( session()->has('cart'))
    @php
        $carts = session()->get('cart');
    @endphp
@endif
<div class="modal modal-custom fade text-md-left" id="cartmodalglobal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="title-cart">
                        <h5>Panier</h5>
                        <img id="cart-spinner" src="{{ asset(('/images/horizontal-spinner.gif')) }}" width="50">
                    </div>
                    <div class="content-cart">
                        <table id="carttable" style="text-align: center">
                            <thead>
                                <tr>
                                <th>voyage</th>
                                <th>Nom</th>
                                <th>Date</th>
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
                                    <td><img src="/storage/voyages/thumbnails/{{ @$cart->getVoyage()->main_photo }}" height="50"></td>
                                    <td>{{ @$cart->getVoyage()->title }}</td>
                                    <td>{{ @$cart->getDate() }}</td>
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
                                    <td colspan="4"></td>
                                    <td style="text-align: right">Prix Total TTC</td>
                                    <td id="finalPrice"><b>{{ $finalPrice }} €</b></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="action">
                        <a href="#" class="button button-google-plus mg-20 pull-left" data-dismiss="modal" aria-label="Close">Continuer mon shopping</a>
                        <a href="#" class="button button-success mg-20 pull-right">Finaliser votre commande</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>