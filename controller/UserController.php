<?php
namespace controller;

use constants\Constants;
use repositories\UserRepository;

/**
 * Class to manage requests related to the User
 *
 * Class UserController
 * @package controller
 */
class UserController extends Controller
{
    /**
     * Shows the for to create a user.
     *
     * Method GET
     * Route ""/user/create"
     *
     */
    public function createUserFormAction()
    {
        $action = "createUserForm";
        // I don't like this, but helps to simplify the url prefix I need to use:
        $urlPrefix = $this->container->getService(Constants::CONFIG_SERVICE)->get('url_prefix');
        include ROOT. "views/layout/layout.php";
    }

    /**
     * Inserts a user in the DB. (Missing proper validation for the input data)
     *
     * Method POST
     * Route ""/user/create"
     *
     */
    public function createUserAction()
    {
        /** @var $userRepository UserRepository */
        $userRepository = $this->container->getService(Constants::USER_REPOSITORY_SERVICE);

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $urlPrefix = $this->container->getService(Constants::CONFIG_SERVICE)->get('url_prefix');

        $user = $userRepository->createUser($name, $email, $password);
        if (!$user) {
            $errorMsg = 'An error occured while creting the user please contact the administrator';
        }
        else {
            $confMsg = 'Your user was properly created. You can login in <a href=" ' . $urlPrefix .  'login ">here</a>';
        }

        $action = "createUser";
        // I don't like this, but helps to simplify the url prefix I need to use:
        $urlPrefix = $this->container->getService('config_service')->get('url_prefix');
        include ROOT. "views/layout/layout.php";
    }

}