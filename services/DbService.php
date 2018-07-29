<?php

namespace services;

use exceptions\UnauthorizedAccessException;
use PDO;

/**
 * Class that manages the connection to the DB.
 *
 * Class DbService
 * @package services
 */
class DbService extends Service
{

    /** @var  $configService ConfigService */
    private $configService;

    /** @var  $helperService HelperService */
    private $helperService;

    /**
     * DbService constructor.
     */
    public function __construct($configService, $helperService){
        $this->configService = $configService;
        $this->helperService = $helperService;
    }

    /**
     * Creates and returns the connection to the DB.
     *
     * @return PDO
     */
    public function getConnection(){
        $dbName = $this->configService->get('db_name');
        $dbHost = $this->configService->get('db_host');
        $dbUsr = $this->configService->get('db_usr');
        $dbPwd = $this->configService->get('db_pwd');
        $dbPort = $this->configService->get('db_port');

        return new PDO("mysql:dbname=$dbName;host=$dbHost;port=$dbPort", $dbUsr, $dbPwd);
    }
}