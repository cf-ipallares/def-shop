<div class="panel panel-default product-list">
    <div class="panel-heading">Basket</div>
    <table class="table">
        <thead><tr><th>Image</th><th>Product Name</th><th>Net Price</th><th>Gross Price</th><th>Color</th><th>Nr. Items</th></tr> </thead>
        <tbody>
        <?php
        foreach ($basket->getBasketItems() as $basketItem) {
            include ROOT . "views/basket/basket_product_list_item.php";
        }
        ?>
        </tbody>
    </table>
</div>