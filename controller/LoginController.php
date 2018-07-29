<?php

namespace controller;

use repositories\UserRepository;
use services\HelperService;
use constants\Constants;

class LoginController extends Controller
{
    /**
     * Method GET
     * Route "/login"
     */
    public function loginFormAction() {
        /** @var HelperService $helperService */
        $helperService = $this->container->getService(Constants::HELPER_SERVICE);
        if ($helperService->isUserLogged()) {
            $redirectUrl = $this->container->getService('config_service')->get('url_prefix') . 'products';
            header("Location: $redirectUrl");
            die;
        }
        else {
            $action = "login";
            // I don't like this, but helps to simplify the url prefix I need to use:
            $urlPrefix = $this->container->getService('config_service')->get('url_prefix');
            include ROOT. "views/layout/layout.php";
        }
    }

    /**
     * Method POST
     * Route "/login"
     */
    public function loginAction() {
        if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
            /** @var $userRepository UserRepository */
            $userRepositoryService = $this->container->getService(Constants::USER_REPOSITORY_SERVICE);
            if ( $user = $userRepositoryService->loginUser($_POST['email'], $_POST['password'])) {
                $redirectUrl = $this->container->getService('config_service')->get('url_prefix') . 'products';
                header("Location: $redirectUrl");
                exit;
            }
            else {
                $errorMsg = "No user with given email and password.";
                $action = "login";
                // I don't like this, but helps to simplify the url prefix I need to use:
                $urlPrefix = $this->container->getService('config_service')->get('url_prefix');
                include ROOT. "views/layout/layout.php";
            }
        }
        else {
            $errorMsg = "Missing required info";
            $action = "login";
            // I don't like this, but helps to simplify the url prefix I need to use:
            $urlPrefix = $this->container->getService('config_service')->get('url_prefix');
            include ROOT. "views/layout/layout.php";
        }
    }

}