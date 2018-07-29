<?php

namespace repositories;

use PDO;
use services\DbService;
use services\HelperService;
use services\ORMService;
use services\Service;

class ProductRepository extends Service
{
    /** @var  $dbService DbService */
    private $dbService;

    /** @var  $helperService HelperService */
    private $helperService;

    /** @var  $ormService ORMService */
    private $ormService;

    /** @var $colors array  */
    private $colors;

    /**
     * UserRepository constructor.
     *
     * @param DbService $dbService
     * @param HelperService $helperService
     * @param ORMService $ormService
     * @param array $colors
     */
    public function __construct(DbService $dbService, HelperService $helperService, ORMService $ormService, array $colors)
    {
        $this->dbService = $dbService;
        $this->helperService = $helperService;
        $this->ormService = $ormService;
        $this->colors = $colors;
    }

    /**
     * Returns all products in the DB.
     *
     * @return array - [ Model\Product ]
     */
    public function findProducts() : array {
        $pdo = $this->dbService->getConnection();
        $sql = "select * from Products";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $productTRS = $stmt->fetchAll(PDO::FETCH_OBJ);
        $pdo = null;

        $products = $this->ormService->convertProducts($productTRS, $this->colors);

        return $products;
    }

    /**
     * Returns a list of products filtered by color.
     *
     * @param int $color
     * @return array
     */
    public function findProductsByColor( int $color) : array {
        $pdo = $this->dbService->getConnection();
        $sql = "select * from Products where color_fk = :color_fk";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':color_fk', $color, PDO::PARAM_INT);
        $stmt->execute();
        $productTRS = $stmt->fetchAll(PDO::FETCH_OBJ);
        $pdo = null;

        $products = $this->ormService->convertProducts($productTRS, $this->colors);

        return $products;
    }

    function findProductsByIds(array $productIds) {
        $pdo = $this->dbService->getConnection();
        $stringProductIds = implode(',', $productIds);
        $sql = "select * from Products where id in ($stringProductIds)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $productTRS = $stmt->fetchAll(PDO::FETCH_OBJ);
        $pdo = null;

        $products = $this->ormService->convertProducts($productTRS, $this->colors);

        return $products;
    }

}