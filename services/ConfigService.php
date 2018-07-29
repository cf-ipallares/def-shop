<?php

namespace services;

/**
 * Class to provide an object with configuration set in parameters.yml
 *
 * Class ConfigService
 * @package services
 */
class ConfigService extends Service
{

    private $configuration;

    /**
     * ConfigService constructor.
     */
    public function __construct() {
        $parametersFile = fopen(ROOT . 'parameters.yml', 'r');
        while(!feof($parametersFile)) {
            $line = trim(fgets($parametersFile));
            $configProperty = explode(":", $line);
            if (count($configProperty) == 2) {
                $this->configuration[trim($configProperty[0])] = trim($configProperty[1]);
            }
        }
        fclose($parametersFile);
    }

    /**
     * Returns the value of a config property or throws an Exception if it doesn't exist.
     *
     * @param string $key
     * @param bool $required
     * @return string
     * @throws \Exception
     */
    public function get(string $key, $required = true) : string {
        if ( (!key_exists($key, $this->configuration ) || empty($this->configuration[$key]))  && $required) {
            throw new \Exception("Missing required configuration parameter");
        }
        return $this->configuration[$key];
    }
}