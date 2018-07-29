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
}

$( document ).ready(init);