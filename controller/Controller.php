<?php
/**
 * Created by PhpStorm.
 * User: ipallares
 * Date: 19.11.17
 * Time: 13:41
 */

namespace controller;


class Controller
{
    protected $container;

    /**
     * Controller constructor.
     *
     * @param $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }


}