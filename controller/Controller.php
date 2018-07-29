<?php
/**
 * Created by PhpStorm.
 * User: ipallares
 * Date: 19.11.17
 * Time: 13:41
 */

namespace controller;


use container\Container;

class Controller
{
    /** @var  $container Container */
    protected $container;

    /**
     * Controller constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }


}