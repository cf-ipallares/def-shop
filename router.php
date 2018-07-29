<?php

use controller\LoginController;
use controller\ProductController;
use controller\BasketController;

$loginController = new LoginController($container);
$productController = new ProductController($container);
$basketController = new BasketController($container);

$routes = [
    'GET/' => array($loginController, 'indexAction'),
    'GET/login' => array($loginController, 'loginFormAction'),
    'POST/login' => array($loginController, 'loginAction'),
    'GET/products' => array($productController, 'productsAction'),
    'POST/category/products' => array($productController, 'categoryProductsAction'),
    'POST/basket/add-product' => array($basketController, 'addProductAction'),
    'GET/basket' => array($basketController, 'basketAction')
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