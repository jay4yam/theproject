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
            var button = $('#buttonToSubmit');
            var price = $('#individual_price');

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
                    console.log(data);
                    //insère le voyage id dans l'input hidden
                    $('#voyage_id').val(data.voyage.id);

                    //recupère le prix du voyage
                    var individualPrice = data.voyage.price;

                    //si le prix est discounte
                    if(data.voyage.is_discounted) {
                        individualPrice = data.voyage.discount_price;
                    }

                    //on inject la valeur dans le form input hidden sur la modal
                    price.val(individualPrice);

                    //affiche le bouton acheter
                    button.fadeIn("slow");

                    //affiche la titre du voyage
                    var modal = '<h6 class="pt100">'+ data.voyage.title +'</h6>';

                    //init. le container
                    var ZeModal = $('#voyage-info-container');

                    //modifie le bg du container
                    ZeModal.css('background', 'url(\'/storage/voyages/thumbnails/'+ data.voyage.main_photo +'\')');

                    //injecte le contenu
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
            var individualPrice = $('#individual_price').val();

            $.ajax({
                type:'POST',
                headers: {'X-CSRF-TOKEN': _token  },
                url: '/ajax/add-voyage-to-cart',
                data: { voyageId:voyageId, numOfVoyagers:numOfVoyagers, dateDeDepart:dateDeDepart, individualPrice:individualPrice }
            }).done(function (data) {
               if(data.success){
                   $('#modal-cart').modal('hide');
                   $('.user-menu-cart').css('display', 'block');
                   $('#details').html(data.numOfVoyage+' - voyage');
                   $('.voyage-counter').css('display', 'block');
                   $('.voyage-counter').html(data.numOfVoyage);
               }
            });
        })
    }
};