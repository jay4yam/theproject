@extends('layouts.back')

@section('content')
    <!-- Box Dernieres ventes-->
    <section class="section-80 bg-wild-wand">
        <div class="container container-custom">
            <div class="row justify-content-sm-center">
                <div class="box box-search bg-default d-block">
                    <div class="box-search-wrap">
                        <!-- RD Search Form-->
                        <h1 class="admin">Dernieres ventes</h1>
                    </div>
                    <div class="box-search-body text-left">
                        <table class="table table-striped table-responsive-sm">
                            <thead>
                            <tr>
                                <th scope="col">#id</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Status Transaction</th>
                                <th scope="col">Paiement commande</th>
                                <th scope="col" style="width:15%">Détails</th>
                                <th scope="col">Prix</th>
                                <th scope="col" style="width:15%">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mainOrders as $order)
                                <tr>
                                    <td scope="row">{{ $order->id }}</td>
                                    <td>{{ $order->user->email }}</td>
                                    <td>{{ $order->stripe_payment_status }}</td>
                                    <td>{{ $order->is_paid ? 'oui' : 'non'  }}</td>
                                    <td>
                                        <a href="#" class="itemsOrder" data-toggle="modal" data-orderId="{{ $order->id }}" data-target="#details_voyage">voir détail</a>
                                    </td>
                                    <td>
                                        @php
                                            $prixFinal = 0;
                                            foreach($order->itemsOrder as $item){
                                                $prixFinal += $item->prix_final;
                                            }
                                        @endphp
                                        {{ $prixFinal }} €
                                    </td>
                                    <td>
                                        <a href="{{ url()->route('voyages.edit', ['id' => $order->id]) }}">
                                            <button class="btn btn-info pull-left">
                                                <i class="fas fa-edit"></i></i>
                                            </button>
                                        </a>
                                        <form class='delete' action="{{ route('voyages.destroy', ['voyage' => $order->id]) }}" method="post">
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button class="btn btn-danger pull-right">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $mainOrders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="details_voyage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Détails voyage</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="details_voyage">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">voyage</th>
                            <th scope="col">nb passager</th>
                            <th scope="col">date du voyage</th>
                            <th scope="col">Prix</th>
                        </tr>
                        </thead>
                        <tbody id="items_info">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dedicated_js')
<script type="text/javascript">
    $(document).ready(function () {
        //Identifie le click sur le bouton detail
        $('.itemsOrder').on('click', function (e) {
            //annnule l'effet sur le lien
            e.preventDefault();

            //recupère l'id du main orders pour récupérer les items order
            var mainOrderId = $(this).attr('data-orderId');

            //requête ajax pour récupérer les datas de chaque itemsOrder
            $.ajax({
                'type': 'get',
                'url' : '/ajax/items-order-info',
                'data': { id:mainOrderId },
                'success':function (data) {
                    var table = null;
                    data.map(function (item) {
                        table += '<tr>';
                        table += '<td><img src="/storage/voyages/thumbnails/'+item.image+'" height="100px"></td>';
                        table += '<td>'+ item.voyage_name +'</td>';
                        table += '<td>'+ item.num_of_passenger+'</td>';
                        table += '<td>'+ item.date_voyage+'</td>';
                        table += '<td>'+ item.prix_final+' €</td>';
                        table += '</tr>';
                    });
                    $('#items_info').html(table);
                }
            });
        });
    })
</script>
@endsection