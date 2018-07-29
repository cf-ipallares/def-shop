<?php

// Router to map urls to controller-action methods

use controller\LoginController;
use controller\ProductController;
use controller\BasketController;
use controller\UserController;
use controller\PaymentController;

$loginController = new LoginController($container);
$productController = new ProductController($container);
$basketController = new BasketController($container);
$userController = new UserController($container);
$paymentController = new PaymentController($container);

$routes = [
    'GET/' => array($loginController, 'indexAction'),
    'GET/login' => array($loginController, 'loginFormAction'),
    'POST/login' => array($loginController, 'loginAction'),
    'GET/products' => array($productController, 'productsAction'),
    'POST/category/products' => array($productController, 'categoryProductsAction'),
    'POST/basket/add-product' => array($basketController, 'addProductAction'),
    'GET/basket' => array($basketController, 'basketAction'),
    'GET/user/create' => array($userController, 'createUserFormAction'),
    'POST/user/create' => array($userController, 'createUserAction'),
    'GET/payment' => array($paymentController, 'paymentAction')
];

$path = str_replace('/def-shop/public/index.php', '', parse_url($_SERVER['REQUEST_URI'])['path']);
$path = str_replace('/def-shop/public', '', $path);
$method = $_SERVER['REQUEST_METHOD'];

if (is_callable($routes[$method.$path])) {
    $routes[$method.$path]();
}
else {
    header('HTTP/1.1 404 Not Found');
    echo '<html><body><h1>Page Not Found</h1></body></html>';
    die;
}