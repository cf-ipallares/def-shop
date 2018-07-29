<?php
namespace controller;

use repositories\ProductRepository;
use repositories\UserRepository;
use services\HelperService;
use constants\Constants;

/**
 * Class to manage requests related to Products.
 *
 * Class ProductController
 * @package controller
 */
class ProductController extends Controller
{
    /**
     * Shows the list of products
     *
     * Method GET
     * Route "/products"
     */
    public function productsAction() {
        /** @var $productRepository ProductRepository */
        $productRepository = $this->container->getService(Constants::PRODUCT_REPOSITORY_SERVICE);
        /** @var  $helperService HelperService*/
        $helperService = $this->container->getService(Constants::HELPER_SERVICE);
        $products = $productRepository->findProducts();

        if ($helperService->isUserLogged()) {
            $user = $helperService->getUserObjFromSession($_SESSION['user_email']);
        }

        $action = "products";
        // I don't like this, but helps to simplify the url prefix I need to use:
        $urlPrefix = $this->container->getService('config_service')->get('url_prefix');
        include ROOT. "views/layout/layout.php";
    }

    /**
     * Shows a list of products filtered by color
     *
     * Method GET
     * Route "/category/products"
     */
    public function colorProductsAction() {
        /** TODO */
        if (isset($_GET['color_id'])) {

        }
    }

}