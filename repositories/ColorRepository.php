<?php

namespace repositories;

use services\DbService;
use services\HelperService;
use services\ORMService;
use services\Service;
use PDO;
use Exception;

class ColorRepository extends Service
{
    /** @var  $dbService DbService */
    private $dbService;

    /** @var  $helperService HelperService */
    private $helperService;

    /** @var  $colors array */
    private $colors;

    /** @var  $ormService ORMService */
    private $ormService;

    /**
     * ColorRepository constructor.
     * @param DbService $dbService
     * @param HelperService $helperService
     */
    public function __construct(DbService $dbService, HelperService $helperService, ORMService $ormService)
    {
        $this->dbService = $dbService;
        $this->helperService = $helperService;
        $this->ormService = $ormService;
    }

    /**
     * @return DbService
     */
    public function getDbService(): DbService
    {
        return $this->dbService;
    }

    /**
     * @param DbService $dbService
     */
    public function setDbService(DbService $dbService)
    {
        $this->dbService = $dbService;
    }

    /**
     * @return HelperService
     */
    public function getHelperService(): HelperService
    {
        return $this->helperService;
    }

    /**
     * @param HelperService $helperService
     */
    public function setHelperService(HelperService $helperService)
    {
        $this->helperService = $helperService;
    }

    /**
     * Returns an array of Color objects witht the Colors in the DB.
     *
     * @return array - [ Model|Color ]
     */
    public function getColors() : array {
        /* To avoid querying everytime we set it as a class property so the query will only happen first time (Caching it would be better) */
        if (!$this->colors) {
            $this->colors = $this->findColors();

        }

        return $this->colors;
    }

    /**
     * Query the database to recover all stored Colors.
     *
     * @return array - Array with Color objects.
     */
    private function findColors() : array {
        $pdo = $this->dbService->getConnection();
        $sql = "select * from Colors";
        /** @var  $stmt PDOStatement */
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $colorTRS = $stmt-> fetchAll(PDO::FETCH_OBJ);
        $pdo = null;
        $colors = $this->ormService->convertColors($colorTRS);

        return $colors;
    }
}