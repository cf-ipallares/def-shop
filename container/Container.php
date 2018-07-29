<?php

namespace container;

use exceptions\ServerErrorException;
use services\Service;

class Container
{
    /** @var  $data array */
    private $data;
    private $services;

    public function addService($key, Service $service) {
        $this->services[$key] = $service;
    }

    public function getService($key) {
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