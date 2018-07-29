<?php
namespace controller;

use repositories\ProductRepository;
use repositories\UserRepository;
use services\HelperService;
use constants\Constants;

class ProductController extends Controller
{
    /**
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
     * Method GET
     * Route "/category/products"
     */
    public function categoryProductsAction() {
        if (isset($_GET['category'])) {
            /** @var HelperService $helperService */
            $helperService = $this->container->getService(Constants::HELPER_SERVICE);
            if ($helperService->isUserLogged()) {
                $this->indexAction();
            }
            else {
                $template = "login.php";
                include ROOT. "views/layout.php";
            }
        }
    }

    /**
     * Method POST
     * Route "/login"
     */
    public function loginAction() {
        if (isset($_POST['user_email']) && !empty($_POST['user_email']) && isset($_POST['user_pwd']) && !empty($_POST['user_pwd'])) {
            /** @var UserRepository $userRepository */
            $userRepositoryService = $this->container->getService(Constants::USER_REPOSITORY_SERVICE);
            if ( $userObj = $userRepositoryService->loginUser($_POST['user_email'], $_POST['user_pwd'])) {
                $infoMsg = "Login Successful";
                $template = "user_menu.php";
                include ROOT. "views/layout.php";
            }
            else {
                $errorMsg = "No user with given email and password.";
                $template = "login.php";
                include ROOT. "views/layout.php";
            }
        }
        else {
            $errorMsg = "Missing required info";
            $template = "login.php";
            include ROOT. "views/layout.php";
        }
    }

}