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
        //todo supprimer ce commentaire
        //if (confirm("Do you really want to delte the product confirm t")) {
        //    alert("oui")
        //}
        //else {
        //    alert("non")
        //}
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

    //When you click on a link with class of poplight and the href starts with a #
    $('button.poplight').on('click', function() {
        var popID = $(this).data('rel'); //Get Popup Name
        var popWidth = $(this).data('width'); //Gets Popup Width
        var productId = $(this).data('productid'); //Gets ProductId
        var productName = $(this).data('productname'); //Gets the name of the product

        $('#' + popID + ' h2').text('Do you realy want to delete this product : ' +  productName + ' ?'); //Modification od the url of the form
        $('#' + popID + ' form').attr('action', 'product/' + productId); //Modification od the url of the form

        //Fade in the Popup and add close button
        $('#' + popID).fadeIn('500').css({'width': popWidth});

        //Define margin for center alignment (vertical + horizontal) - we add 80 to the height/width to accomodate for the padding + border width defined in the css
        var popMargTop = ($('#' + popID).height() + 80) / 2;
        var popMargLeft = ($('#' + popID).width() + 80) / 2;

        //Apply Margin to Popup
        $('#' + popID).css({
            'margin-top'  : -popMargTop,
            'margin-left' : -popMargLeft
        });

        //Fade in Background
        $('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
        $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer

        return false;
    });


    //Close Popups and Fade Layer
    $('body').on('click', 'button.close, #fade', function() { //When clicking on the close or fade layer...
        $('#fade, .popup_block').fadeOut(function() {
            $('#fade').remove();
        }); //fade them both out

        return false;
    });

});
