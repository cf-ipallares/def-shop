<?php

namespace repositories;

use model\Basket;
use model\Product;
use model\User;
use services\DbService;
use services\HelperService;
use services\Service;
use PDO;

class OrderRepository extends Service
{
    /** @var  $dbService DbService */
    private $dbService;

    /** @var  $helperService HelperService */
    private $helperService;

    /**
     * UserRepository constructor.
     *
     * @param $dbService
     * @param $helperService
     */
    public function __construct($dbService, $helperService)
    {
        $this->dbService = $dbService;
        $this->helperService = $helperService;
    }

    /**
     * Inserts an order in the DB
     *
     * @param Basket $basket
     * @return bool
     */
    public function insertOrder(Basket $basket, int $userId, int $paymentMethod) {
        try {
            $pdo = $this->dbService->getConnection();
            $pdo->beginTransaction();

            $basketNetPrice = $basket->getTotalNetPrice();
            $basketGrossPrice = $basket->getTotalGrossPrice();

            $sql = "insert into Orders(net_price, gross_price, user_fk, payment_method) values (:net_price, :gross_price, :user_fk, :payment_method)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':net_price', $basketNetPrice, PDO::PARAM_STR);
            $stmt->bindParam(':gross_price', $basketGrossPrice, PDO::PARAM_STR);
            $stmt->bindParam(':user_fk', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':payment_method', $paymentMethod, PDO::PARAM_INT);
            $stmt->execute();

            $orderId = $pdo->lastInsertId();

            foreach ($basket->getBasketItems() as $basketItem) {
                $quantity = $basketItem->getCtr();
                /** @var  $product Product */
                $product = $basketItem->getProduct();
                $productId = $product->getId();
                $productNetPrice = $product->getNetPrice();
                $productGrossPrice = $product->getGrossPrice();
                $basketItemNetPrice = $quantity*$productNetPrice;
                $basketItemGrossPrice = $quantity*$productGrossPrice;
                $tax = $product->getTax();

                $sql = "insert into Orders_Products(order_fk, product_fk, quantity, net_price, gross_price, tax) values (:order_fk, :product_fk, :quantity, :net_price, :gross_price, :tax)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':order_fk', $orderId, PDO::PARAM_INT);
                $stmt->bindParam(':product_fk', $productId, PDO::PARAM_INT);
                $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmt->bindParam(':net_price', $basketItemNetPrice, PDO::PARAM_INT);
                $stmt->bindParam(':gross_price', $basketItemGrossPrice, PDO::PARAM_INT);
                $stmt->bindParam(':tax', $tax, PDO::PARAM_INT);

                $stmt->execute();

            }

            $pdo->commit();
            $pdo = null;
        }catch(\PDOException $e) {
            $pdo->rollBack();
        }

    }
}