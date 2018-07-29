<?php
namespace controller;

use repositories\BasketRepository;
use services\HelperService;
use constants\Constants;

/**
 * Class to managre requests related to Basket management
 *
 * Class BasketController
 * @package controller
 */
class BasketController extends Controller
{
    /**
     * Adds product to the basket or increases the quantity of such product if there was already one.
     *
     * Method POST
     * Route ""/basket/add-product"
     * Parameters: id
     */
    public function addProductAction()
    {
        /** @var HelperService $helperService */
        $helperService = $this->container->getService(Constants::HELPER_SERVICE);

        $productId = @$_POST['id'];
        if (empty($productId)) {
            $helperService->respondServerError( $logErrorMsg = "No product id to be added in the basket.");
        }

        /** @var  $basketRepository BasketRepository */
        $basketRepository = $this->container->getService(Constants::BASKET_REPOSITORY_SERVICE);
        $basketRepository->addProductToBasket($productId);

        header('Content-Type: application/json');
        echo json_encode(['result' => 'ok']);
        die;
    }

    /**
     * Shows the basket contents
     *
     * Method GT
     * Route ""/basket"
     *
     */
    public function basketAction() {
        /** @var  $basketRepository BasketRepository */
        $basketRepository = $this->container->getService(Constants::BASKET_REPOSITORY_SERVICE);
        $basket = $basketRepository->getBasket();
        $action = "basket";

        // I don't like this, but helps to simplify the url prefix I need to use:
        $urlPrefix = $this->container->getService('config_service')->get('url_prefix');
        include ROOT. "views/layout/layout.php";
    }
}