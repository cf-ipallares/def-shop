<?php
namespace controller;



use constants\Constants;
use model\User;
use repositories\BasketRepository;
use repositories\OrderRepository;
use repositories\UserRepository;

class PaymentController extends Controller
{
    /**
     * Method GET
     * Route ""/payment"
     * parameters: payment_method
     */
    public function paymentAction()
    {
        // NOTE: To simplify I am implementing the action with a GET method (No validations, or actions taken whatsoever other than saving the order and confirming)

        $paymentMethod = $_GET['payment_method'];


        /** @var  $helperService HelperService*/
        $helperService = $this->container->getService(Constants::HELPER_SERVICE);
        if ($helperService->isUserLogged()) {
            /** @var  $user User */
            $user = $helperService->getUserObjFromSession($_SESSION['user_email']);
        }

        /** @var  $basketRepository BasketRepository */
        $basketRepository = $this->container->getService(Constants::BASKET_REPOSITORY_SERVICE);
        $basket = $basketRepository->getBasket();

        /** @var  $orderRepository OrderRepository */
        $orderRepository = $this->container->getService(Constants::ORDER_REPOSITORY_SERVICE);
        $orderRepository->insertOrder($basket, $user->getId(), $paymentMethod);

        // TODO: Insert the order in the DB
        $action = "payment";
        // I don't like this, but helps to simplify the url prefix I need to use:
        $urlPrefix = $this->container->getService(Constants::CONFIG_SERVICE)->get('url_prefix');
        $confMsg = 'Your order has been confirmed.';
        unset($_SESSION['basket']);
        include ROOT. "views/layout/layout.php";
    }
}