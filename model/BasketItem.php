<?php

namespace model;

/**
 * Model that contains the info related to an item in the Basket.
 *
 * Class BasketItem
 * @package model
 */
class BasketItem {

    /** @var $ctr int */
    private $ctr;
    /** @var $product Product */
    private $product;

    /**
     * BasketItem constructor.
     * @param int $ctr
     * @param Product $product
     */
    public function __construct($ctr, Product $product)
    {
        $this->ctr = $ctr;
        $this->product = $product;
    }

    /**
     * @return int
     */
    public function getCtr(): int
    {
        return $this->ctr;
    }

    /**
     * @param int $ctr
     */
    public function setCtr(int $ctr)
    {
        $this->ctr = $ctr;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
    }
}