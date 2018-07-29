<?php

namespace model;

/**
 * Model that contains the info related to Basket.
 *
 * Class Basket
 * @package model
 */
class Basket {

    /** @var $basketItems array */
    private $basketItems;

    /**
     * Basket constructor.
     * @param array $basketItems
     */
    public function __construct(array $basketItems = [])
    {
        $this->basketItems = $basketItems;
    }

    /**
     * @return array
     */
    public function getBasketItems(): array
    {
        return $this->basketItems;
    }

    /**
     * @param array $basketItems
     */
    public function setBasketItems(array $basketItems)
    {
        $this->basketItems = $basketItems;
    }


    /**
     * @param BasketItem $basketItem
     */
    public function addBasketItem(BasketItem $basketItem) {
        $this->basketItems[] = $basketItem;
    }

    public function getTotalNetPrice() {
        $totalNetPrice = 0;
        foreach($this->basketItems as $basketItem) {
            /** @var $product Product */
            $product = $basketItem->getProduct();
            $productCtr = $basketItem->getCtr();
            $productNetPrice = $product->getNetPrice();
            $totalNetPrice += $productNetPrice* $productCtr;
        }

        return $totalNetPrice;
    }

    public function getTotalGrossPrice() {
        $totalGrossPrice = 0;
        foreach($this->basketItems as $basketItem) {
            /** @var $product Product */
            $product = $basketItem->getProduct();
            $productCtr = $basketItem->getCtr();
            $productGrossPrice = $product->getGrossPrice();
            $totalGrossPrice += $productGrossPrice* $productCtr;
        }

        return $totalGrossPrice;
    }

}