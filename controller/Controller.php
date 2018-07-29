<?php

namespace controller;

use container\Container;

/**
 * Parent class for all Controllers.
 *
 * Class Controller
 * @package controller
 */
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