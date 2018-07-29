<?php
namespace controller;



class UserController extends Controller
{
    /**
     * Method GET
     * Route ""/user/create"
     *
     */
    public function createUserFormAction()
    {
        $action = "createUserForm";
        // I don't like this, but helps to simplify the url prefix I need to use:
        $urlPrefix = $this->container->getService('config_service')->get('url_prefix');
        include ROOT. "views/layout/layout.php";
    }

    /**
     * Method POST
     * Route ""/user/create"
     *
     */
    public function createUserAction()
    {
        /* TODO: Create the user in the DB */


        $action = "createUser";
        // I don't like this, but helps to simplify the url prefix I need to use:
        $urlPrefix = $this->container->getService('config_service')->get('url_prefix');
        include ROOT. "views/layout/layout.php";
    }

}