<!-- Payment methods -->

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