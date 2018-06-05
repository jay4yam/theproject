/*
    Javascript d'ajout au panier
    le 5/06/2018 by JayBen
 */

var cartJs = {

    // cibling bouton add to cart
    cart: $('.add-to-cart'),

    // cibling bouton submit cart
    buttonSubmit: $('#buttonToSubmit'),

    // Fonction ajax qui recupère les infos du voyage
    AddToCart:function () {
        this.cart.on('click', function () {
            var that = $(this);
            var id = that.data('content');
            $.ajax({
                'type': 'get',
                'url' : '/ajax/voyage-info/',
                'data': { id:id },
                'beforeSend':function () {
                    var ZeModal = $('#voyage-info-container');
                    ZeModal.html('<img src="/images/spinner.gif">');
                    ZeModal.css('background', 'url(\'/storage/voyages/thumbnails/\')');
                },
                'success':function (data) {
                    $('#voyage_id').val(data.voyage.id)
                    var modal = '<h6 class="pt100">'+ data.voyage.title +'</h6>';
                    var ZeModal = $('#voyage-info-container');
                    ZeModal.css('background', 'url(\'/storage/voyages/thumbnails/'+ data.voyage.main_photo +'\')');
                    ZeModal.html(modal);
                }
            });
        });
    },

    // Fonction ajax qui soumet les infos du formulaire
    ResponseAfterSubmit:function () {

        this.buttonSubmit.on('click', function(e){
            e.preventDefault();

            var voyageId = $('#voyage_id').val();
            var numOfVoyagers = $('select[name="nb_passager"]').find(':selected').text();
            var dateDeDepart = $('input[name="date_souhaitee"]').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                type:'POST',
                headers: {'X-CSRF-TOKEN': _token  },
                url: '/ajax/add-voyage-to-cart',
                data: { voyageId:voyageId, numOfVoyagers:numOfVoyagers, dateDeDepart:dateDeDepart }
            }).done(function (data) {
               if(data.success){
                   $('#modal-cart').modal('hide');
               }
            });
        })
    }
};