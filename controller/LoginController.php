<?php

namespace controller;

use repositories\UserRepository;
use services\HelperService;
use constants\Constants;

class LoginController extends Controller
{
    /**
     * Method GET
     * Route "/"
     */
    public function indexAction() {
        /** @var HelperService $helperService */
        $helperService = $this->container->getService(Constants::HELPER_SERVICE);
        if (!$helperService->isUserLogged()) {
            $this->loginFormAction();
        }
        else {
            $userObj = $helperService->getUserObjFromSession($_SESSION['user_email']);
            $template = "user_menu.php";
            include ROOT. "views/layout.php";
        }
    }

    /**
     * Method GET
     * Route "/login"
     */
    public function loginFormAction() {
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