<div class="main container">
    <div class="row">
        <div class="col-xs-12" role="main">
        <?php
        if (isset($action) && $action == 'products') {
            include ROOT . "views/product/product_list.php";
        }
        else if (isset($action) && $action == 'basket') {
            include ROOT . "views/basket/basket.php";
        }
        else if (isset($action) && $action == 'createUserForm' || $action == 'createUser') {
            include ROOT . "views/user/create_user.php";
        }
        else if (isset($action) && $action == 'login') {
            include ROOT . "views/user/login.php";
        }
        else if (isset($action) && $action == 'payment') {
            include ROOT . "views/payment/payment_confirmation.php";
        }
        ?>
    </div>
</div>
