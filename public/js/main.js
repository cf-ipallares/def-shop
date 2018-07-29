init = function() {
    $('a.add-to-basket').click(function() {
        var url  = $(this).data('url');
        var productId = $(this).data('product-id');
        $.ajax( {
            method: 'POST',
            url: url,
            data: {id: productId},
            success: function() {
                alert( "success" );
            },
            error: function() {
                alert("error");
            }
        });
    })

    $('.def-shop-basket-button').click( function() {
        document.location.href=$(this).data('basket-url');
    });

    $('.def-shop-payment-method').click( function() {
        // NOTE: To simplify I am implementing the action with a GET method (No validations, or actions taken whatsoever other than saving the order and confirming)
        var paymentUrl = $(this).data('payment-url') + "?payment_method=" + $(this).data('payment-method');
        document.location.href=paymentUrl;
    });
}

$( document ).ready(init);