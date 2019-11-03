/*
    Javascript d'ajout au panier
    le 5/06/2018 by JayBen
 */

const cartJs = {

    // cibling bouton add to cart
    cart: $('.add-to-cart'),

    // cibling bouton submit cart
    buttonSubmit: $('#buttonToSubmit'),

    ZeModal: $('#voyage-info-container'),

    voyage: '',

    _token: $('input[name="_token"]').val(),

    // Affiche la modal du cart dès lors que un utilisateur click sur l'ajout au panier
    showModal:function () {
        this.cart.on('click', function () {
            const that = $(this);
            const id = that.data('content');
            const button = $('#buttonToSubmit');
            const price = $('#individual_price');

            //fonction ajax qui récupère les informations du voyage
            $.ajax({
                'type': 'get',
                'url' : '/ajax/voyage-info/',
                'data': { id:id },
                'beforeSend':function () {
                    //affiche le spinner
                    cartJs.ZeModal.html('<img src="/images/spinner.gif" alt="">');
                    cartJs.ZeModal.css('background', 'url(\'/storage/voyages/thumbnails/\')');
                },
                'success':function (data) {
                    //insère le voyage id dans l'input hidden
                    $('#voyage_id').val(data.voyage.id);

                    //recupère le prix du voyage
                    let individualPrice = data.voyage.price;

                    //si le prix est discounte
                    if(data.voyage.is_discounted) {
                        individualPrice = data.voyage.discount_price;
                    }

                    //on inject la valeur dans le form input hidden sur la modal
                    price.val(individualPrice);

                    //affiche le bouton acheter
                    button.fadeIn("slow");

                    //affiche la titre du voyage
                    let modal = '<h6 class="pt100">'+ data.voyage.title +'</h6>';

                    //init. le container
                    //let ZeModal = $('#voyage-info-container');

                    //modifie le bg du container
                    cartJs.ZeModal.css('background', 'url(\'/storage/voyages/thumbnails/'+ data.voyage.main_photo +'\')');

                    //injecte le contenu
                    cartJs.ZeModal.html(modal);
                }
            });
        });
    },

    // Fonction ajax qui envoie les infos du formulaire dès l'ajout au panier
    addToCart:function () {

        cartJs.buttonSubmit.on('click', function(e){
            e.preventDefault();

            const voyageId = $('#voyage_id').val();
            const numOfVoyagers = $('select[name="nb_passager"]').find(':selected').text();
            const dateDeDepart = $('input[name="date_souhaitee"]').val();
            const individualPrice = $('#individual_price').val();
            const table = $('#carttable');
            const finalPrice = $('#finalPrice');
            const voyage_counter = $('.voyage-counter');

            $.ajax({
                type:'POST',
                headers: { 'X-CSRF-TOKEN': cartJs._token  },
                url: '/ajax/add-voyage-to-cart',
                data: { voyageId:voyageId, numOfVoyagers:numOfVoyagers, dateDeDepart:dateDeDepart, individualPrice:individualPrice }
            }).success(function (data) {
                   //masque la modal d'ajout au panier
                   $('#modal-cart').modal('hide');
                   //affiche le bouton "cart" dans le menu utilisateur
                   $('.user-menu-cart').css('display', 'block');
                   // affiche le nombre de voyage
                   $('#details').html(data.numOfVoyage+' - voyage');
                   //affiche le picto nb de voyage
                   voyage_counter.css('display', 'block');
                   //insère le nombre de voyage dans le picto
                   voyage_counter.html(data.numOfVoyage);

                   //Ligne <tr> d'un tableau qui sera rajoutée à la fin du tableau ou dans le tableau
                   let tr = '<tr>';
                       tr += '<td>';
                       tr += '<img src="/storage/voyages/thumbnails/'+ data.voyage.main_photo +'" width="50"></td>';
                       tr += '<td>'+ data.voyage.title+'</td>';
                       tr += '<td>'+ dateDeDepart +'</td>';
                       tr += '<td><input type="number" class="updatevoyageur" value="'+ numOfVoyagers +'" data-target="'+ data.cart.cle +'"></td>';
                       tr += '<td id="individualPrice-'+ data.cart.cle +'">'+ individualPrice +' €</td>';
                       tr += '<td id="finalPrice-'+ data.cart.cle +'">'+ numOfVoyagers * individualPrice +' €</td>';
                       tr += '<td>';
                       tr += '<a href="#" data-target="'+ data.cart.cle +'" class="deletefromcart">';
                       tr += '<i class="fas fa-trash"></i></a>';
                       tr += '</td></tr>';

                       //Si le tableau n'à pas de ligne '<tr></tr>'
                   if(table[0].tBodies[0].children.length === 0){
                        $('#carttable tbody').after(tr);
                   }else{
                       //si il en a, on ajoute la nouvelle ligne à la fin
                        $('#carttable tbody tr:last').after(tr);
                   }

                   let newFinalPrice = cartJs.UpdatePrice();
                   finalPrice.html(newFinalPrice+' €');
            });
        })
    },

    //Gère la suppréssion d'un voyage du panier
    removeFromCart:function () {
        //au click sur le bouton delete dans une des lignes 'tr' du tableau
        $(document).on('click', '.deletefromcart' , function (e) {
            //empeche la propagation
            e.preventDefault();
            let that = $(this);
            // Récupère la ligne entiere
            let item = that[0].closest('tr');
            //Récupère la valeur qui correspond au nombre d'item dans la session cart
            let sessionArrayNum = that.attr('data-target');

            //Requête ajax de suppréssion d'article dans le panier
            $.ajax({
                url:'/ajax/removefromcart',
                data:{'indexArrayofSessionCart':sessionArrayNum},
                type: 'get',
                beforeSend:function(){
                    $('#cart-spinner').show();
                }
            }).success(function (data) {
                $('#cart-spinner').hide();
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

                let finalPrice = $('#finalPrice');
                let newFinalPrice = cartJs.UpdatePrice();
                finalPrice.html(newFinalPrice+' €');
            });
        })
    },

    //Gère les events du changement de quantité de voyageur pour un vol
    updateQuantity:function () {
        let button = $('.updatevoyageur');
        let finalPrice = $('#finalPrice');

        $(document).on('change', '.updatevoyageur', function () {
            let that = $(this);
            let sessionArrayNum = that.attr('data-target');
            let newQuantity = that.val();
            let individualString = $('#individualPrice-'+sessionArrayNum).html();
            let individualPrice = individualString.split(' ');

            $.ajax({
                type:'get',
                url: '/ajax/update-quantity',
                data: { 'sessionArray':sessionArrayNum, 'newQuantity':newQuantity },
                beforeSend:function(){
                    $('#cart-spinner').show();
                }
            }).success(function () {
                $('#cart-spinner').hide();
                let tdFinalePrice = $('#finalPrice-'+sessionArrayNum);
                tdFinalePrice.html( newQuantity * individualPrice[0] +' €');
                let newFinalPrice = cartJs.UpdatePrice();
                finalPrice.html(newFinalPrice+' €');
            })
        });

    },

    //fonction privee qui calcul et modifie le prix final
    /**
     * @return {number}
     */
    UpdatePrice:function () {
        var tdPrices = $("td[id*='finalPrice-']");
        var finalPrice = 0;
        tdPrices.each(function (event, item) {
            var htmlValue = $(item).html();
            var arrayValue = htmlValue.split(' ');
            var value = arrayValue[0];
            finalPrice += parseFloat(value);
        });
        return finalPrice;
    }
};

cartJs.showModal();
cartJs.addToCart();
cartJs.removeFromCart();
cartJs.updateQuantity();