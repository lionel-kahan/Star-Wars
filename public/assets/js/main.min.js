$(document).ready(function() {
    //Incrémentation de la quantité d'un produit dans le panier
    $('.btnPlus').on('click', function(e) {
        var productId = $(this).attr('productId');

            $.ajax({
                url: "http://localhost:8000/incrementProductInCart/" + productId,
                dataType: "jsonp",
                complete : function(jqXHR, textStatus){
                    if (jqXHR.status != 200) {
                        // Requête en erreur
                        console.log("Erreur" + status);
                    } else {
                        var response = JSON.parse(jqXHR.responseText);
                        $('#qte_' + productId).text( response.quantity );
                        $('#totalPrice').text( response.totalPrice.toFixed(2));
                    }
                }
            });
    });

    //Décrémentation de la quantité d'un produit dans le panier
    $('.btnMoins').on('click', function(e) {
        var productId = $(this).attr('productId');

        $.ajax({
            url: "http://localhost:8000/decrementProductInCart/" + productId,
            dataType: "jsonp",
            complete : function(jqXHR, textStatus){
                if (jqXHR.status != 200) {
                    // Requête en erreur
                    console.log("Erreur" + status);
                } else {
                    var response = JSON.parse(jqXHR.responseText);
                    $('#nbProdInCart').text( response.nbProd );

                    if (response.nbProd == 0) {
                        $('#tabCart').after('<h2 class="txtcenter">Your cart is empty</h2>')
                        $('#tabCart').remove();
                        $('#formCommand').remove();
                    }
                    else {
                        $('#totalPrice').text( response.totalPrice.toFixed(2) );

                        if (response.quantity == 0) {
                            $('#ligne_produit_' + productId).remove();
                        } else {
                            $('#qte_' + productId).text( response.quantity );
                        }
                    }
                }
            }
        });
    });

    //Suppression d'un produit dans le panier
    $('.btnSuppr').on('click', function(e) {
        var productId = $(this).attr('productId');

        $.ajax({
            url: "http://localhost:8000/removeCart/" + productId,
            dataType: "jsonp",
            complete : function(jqXHR, textStatus){
                if (jqXHR.status != 200) {
                    // Requête en erreur
                    console.log("Erreur" + status);
                } else {
                    var response = JSON.parse(jqXHR.responseText);
                    $('#nbProdInCart').text( response.nbProd );

                    if (response.nbProd == 0) {
                        $('#tabCart').after('<h2 class="txtcenter">Your cart is empty</h2>')
                        $('#tabCart').remove();
                        $('#formCommand').remove();
                    }
                    else {
                        $('#ligne_produit_' + productId).remove();
                        $('#totalPrice').text( response.totalPrice.toFixed(2) );
                    }
                }
            }
        });
    });
});
