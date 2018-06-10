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
                    <div class="title-cart"><h5>Panier</h5></div>
                    <div class="content-cart">
                        <table style="text-align: center">
                            <thead>
                                <tr>
                                <th>voyage</th>
                                <th>Nom</th>
                                <th>Date</th>
                                <th>Nb Voyageur</th>
                                <th>Prix Unitaire</th>
                                <th>Prix Final</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php $finalPrice = 0; @endphp
                                @foreach($carts as $cart)
                                <tr>
                                    <td><img src="/storage/voyages/thumbnails/{{ $cart->getVoyage()->main_photo }}" height="70"></td>
                                    <td>{{ $cart->getVoyage()->title }}</td>
                                    <td>{{ $cart->getDate() }}</td>
                                    <td>{{ $cart->getNbVoyageur() }}</td>
                                    <td>{{ $cart->getUnitPrice() }} €</td>
                                    <td>{{ $cart->getFinalPrice() }} €</td>
                                </tr>
                                @php $finalPrice += $cart->getFinalPrice(); @endphp
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" style="text-align: right">Prix Total TTC</td>
                                    <td><b>{{ $finalPrice }} €</b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="action">
                        <a href="" class="button button-success mg-20 pull-right">Finaliser votre commande</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>