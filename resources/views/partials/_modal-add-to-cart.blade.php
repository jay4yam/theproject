<div class="modal modal-custom fade text-center show" id="modal-cart" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" id="modal-content">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div id="voyage-info-container" class="col-md-5 img-bg-voyage">
                            <img src="/images/spinner.gif">
                        </div>
                        <div class="col-md-7">
                            <div class="modal-body-column-content">
                                <h6>Programmer votre vol avec EasyCopter</h6>
                                {{ Form::open(['route' => ['add.to.cart.voyage'], 'method' => 'post']) }}
                                {{ Form::hidden('voyage_id', null, ['id' => 'voyage_id']) }}
                                <table class="table-cart">
                                    <thead>
                                    <tr>
                                        <th>Nb Passagers</th>
                                        <th>Date du voyage</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            {{ Form::select('nb_passager', ['1', '2', '3', '4', '5'], null, ['class' => 'form-select-cart']) }}
                                        </td>
                                        <td>
                                            {{ Form::date('date_souhaiter', now(), ['class' => 'form-control']) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding:  20px 0;">
                                            {{ Form::submit('Acheter', ['class' => 'btn button-primary']) }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>