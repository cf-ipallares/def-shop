<?php

namespace repositories;

use constants\Constants;
use model\Basket;
use model\BasketItem;
use services\Service;

/**
 * Repository to manage tasks related to the Basket.
 *
 * Class BasketRepository
 * @package repositories
 */
class BasketRepository extends Service
{
    /** @var  $productRepository ProductRepository */
    private $productRepository;

    /**
     * BasketRepository constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Logic to add a product to the basket.
     * If the product is already in the basket it increases the quantity for such product.
     *
     * @param int $productId
     */
    public function addProductToBasket(int $productId) {
        $jsonBasket = $_SESSION[Constants::BASKET_COOKIE_NAME];
        if ($jsonBasket && !empty($jsonBasket)) {
            $basket = json_decode($jsonBasket, true);
            $productCtr = $basket[$productId];
            if ($productCtr) {
                $basket[$productId] = $productCtr + 1;
            }
            else {
                $basket[$productId] = 1;
            }
        }
        else {
            $basket[$productId] = 1;
        }
        $_SESSION[Constants::BASKET_COOKIE_NAME] = json_encode($basket);

    }

    /**
     * Gets the basket contents with all info necessary in frontend.
     *
     * @return Basket
     */
    public function getBasket() : Basket {
        $basketProducts = [];
        $jsonBasket = $_SESSION[Constants::BASKET_COOKIE_NAME];
        if ($jsonBasket && !empty($jsonBasket)) {
            $basketProducts = json_decode($jsonBasket, true);
        }

        $basketProductIds = array_keys($basketProducts);
        $products = $this->productRepository->findProductsByIds($basketProductIds);

        $basket = new Basket();
        foreach($products as $product) {
            $productCtr = $basketProducts[$product->getId()];
            $basketItem = new BasketItem($productCtr, $product);
            $basket->addBasketItem($basketItem);
        }

        return $basket;
    }
}