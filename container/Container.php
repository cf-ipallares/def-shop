<?php

namespace container;

use exceptions\ServerErrorException;
use services\Service;

/**
 * Class to make services and information available all along the code.
 *
 * Class Container
 * @package container
 */
class Container
{
    /** @var  $data array */
    private $data;
    /** @var  $services array */
    private $services;

    /**
     * @param string $key
     * @param Service $service
     */
    public function addService(string $key, Service $service) {
        $this->services[$key] = $service;
    }

    /**
     * @param string $key
     * @return mixed
     * @throws ServerErrorException
     */
    public function getService(string $key) {
        if (!key_exists($key, $this->services)) {
            throw new ServerErrorException();
        }
        return $this->services[$key];
    }

    /**
     * Adds information to be available all along the code.
     *
     * @param string $key
     * @param mixed $data
     */
    public function addData(string $key, mixed $data) {
        $this->data[$key] = $data;
    }

    /**
     * Get information from the container
     *
     * @param string $key
     * @return mixed
     * @throws ServerErrorException
     */
    public function getData(string $key) : mixed {
        if (!key_exists($key, $this->data)) {
            throw new ServerErrorException();
        }
        return $this->data[$key];
    }

}