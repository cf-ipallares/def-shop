<?php
    $basketUrl = $urlPrefix. "basket";
    if (isset($user) && @$user->getName()) {
        echo '<div class="def-shop-hello-user">Hello ' . $user->getName().  '</div>';
    }
?>



<button type="button" class="btn btn-default btn-lg def-shop-basket-button" data-basket-url="<?php echo $basketUrl ?>">
  <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Basket
</button>


<div class="panel panel-default product-list">
    <div class="panel-heading">Product List</div>

    <table class="table">
        <thead><tr><th>Name</th><th>Net Price</th><th>Gross Price</th><th>Color</th><th>Actions</th></tr> </thead>
        <tbody>
            <?php
                foreach ($products as $product) {
                    include ROOT ."views/product/product_list_item.php";
                }
            ?>
        </tbody>
    </table>
</div>