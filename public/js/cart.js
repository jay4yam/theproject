/*
    Javascript d'ajout au panier
    le 5/06/2018 by JayBen
 */

var cartJs = {

    // cibling bouton add to cart
    cart: $('.add-to-cart'),

    // cibling bouton submit cart
    buttonSubmit: $('#buttonToSubmit'),

    voyage: '',

    // Fonction ajax qui recupère les infos du voyage
    // Pour injecter dans la modal d'ajout au panier
    // Modal dans laquelle l'internaute va choisir sa date de départ
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
            var table = $('#carttable');

            $.ajax({
                type:'POST',
                headers: {'X-CSRF-TOKEN': _token  },
                url: '/ajax/add-voyage-to-cart',
                data: { voyageId:voyageId, numOfVoyagers:numOfVoyagers, dateDeDepart:dateDeDepart, individualPrice:individualPrice }
            }).done(function (data) {
               if(data.success){
                   //masque la modal d'ajout au panier
                   $('#modal-cart').modal('hide');
                   //affiche le bouton "cart" dans le menu utilisateur
                   $('.user-menu-cart').css('display', 'block');
                   // affiche le nombre de voyage
                   $('#details').html(data.numOfVoyage+' - voyage');
                   //affiche le picto nb de voyage
                   $('.voyage-counter').css('display', 'block');
                   //insère le nombre de voyage dans le picto
                   $('.voyage-counter').html(data.numOfVoyage);

                   //Ligne <tr> d'un tableau qui sera rajoutée à la fin du tableau ou dans le tableau
                   var tr = '<tr>';
                       tr += '<td>';
                       tr += '<img src="/storage/voyages/thumbnails/'+ data.voyage.main_photo +'" height="50"></td>';
                       tr += '<td>'+ data.voyage.title+'</td>';
                       tr += '<td>'+ dateDeDepart +'</td>';
                       tr += '<td>'+ numOfVoyagers +'</td>';
                       tr += '<td>'+ individualPrice +' €</td>';
                       tr += '<td>'+ numOfVoyagers * individualPrice +' €</td>';
                       tr += '<td>';
                       tr += '<a href="#" data-target="'+ data.cart.num +'" class="deletefromcart">';
                       tr += '<i class="fas fa-trash"></i></a>';
                       tr += '</td></tr>';

                       //Si le tableau n'à pas déjà de lignes '<tr></tr>'
                   if(table[0].tBodies[0].children.length === 0){
                       $('#carttable tbody').after(tr);
                   }else{
                       //si il en a, on ajoute la nouvelle ligne à la fin
                   $('#carttable tbody tr:last').after(tr);
                   }
               }
            });
        })
    },

    //Gère la suppérsion d'un voyage du panier
    RemoveFromCart:function () {

        //au click sur le bouton delete dans une des lignes 'tr' du tableau
        $(document).on('click', '.deletefromcart' , function (e) {
            //empeche la propagation
            e.preventDefault();
            // Récupère la ligne entiere
            var item = $(this)[0].closest('tr');
            //Récupère la valeur qui correspond au nombre d'item dans la session cart
            var sessionArrayNum = $(this).attr('data-target') - 1;

            //Requête ajax de suppréssion d'article dans le panier
            $.ajax({
                url:'/ajax/removefromcart',
                data:{'indexArrayofSessionCart':sessionArrayNum},
                type: 'get'
            }).done(function (data) {
                //efface la ligne du tableau carttable
                item.remove();
                // change le nombre de voyage
                $('.voyage-counter').html(data.numOfVoyage);
                // insère le nombre de voyages le span détails
                $('#details').html(data.numOfVoyage+' - voyage(s)');
                //si le nombre de voyage en session est null ou egale à zéro, on ne l'affiche plus.
                if(data.numOfVoyage === 0){
                    //efface le panier de la page
                    $('.user-menu-cart').fadeOut();
                }
            })
        })
    }
};