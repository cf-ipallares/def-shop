<?php

namespace services;

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

    public function get($key, $required = true) {
        if ( (!key_exists($key, $this->configuration ) || empty($this->configuration[$key]))  && $required) {
            throw new \Exception("Missing required configuration parameter");
        }
        return $this->configuration[$key];
    }
}