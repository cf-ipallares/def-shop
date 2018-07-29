<?php
    $paymentUrl = $urlPrefix. "payment";
    if (isset($user) && @$user->getName()) {
        echo '<div class="def-shop-hello-user">Hello ' . $user->getName().  '</div>';
    }
?>


<button type="button" class="btn btn-default btn-lg def-shop-payment-method" data-payment-method="1" data-payment-url="<?php echo $paymentUrl ?>">
    <span class="glyphicon glyphicon-euro" aria-hidden="true"></span>Payment Method 1
</button>

<button type="button" class="btn btn-default btn-lg def-shop-payment-method" data-payment-method="2" data-payment-url="<?php echo $paymentUrl ?>">
    <span class="glyphicon glyphicon-euro" aria-hidden="true"></span>Payment Method 2
</button>

<?php
    include ROOT . "views/basket/basket_product_list.php";

    $totalNetPrice = $basket->getTotalNetPrice();
    $totalGrossPrice = $basket->getTotalGrossPrice();
    $totalTaxes = $totalNetPrice - $totalGrossPrice;
?>

<div class="panel panel-default product-list">
    <div class="panel-heading">Totals</div>
    <table class="table">
        <thead><tr><th>Total Net</th><th>Total Gross</th><th>Taxes</th></tr> </thead>
        <tbody>
        <tr>
            <td><?php echo $totalNetPrice ?>€</td>
            <td><?php echo $totalGrossPrice ?>€</td>
            <td><?php echo $totalTaxes ?>€</td>
        </tr>
        </tbody>
    </table>
</div>