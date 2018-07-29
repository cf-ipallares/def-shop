<?php

namespace model;

/**
 * Model that contains the info related to Products.
 *
 * Class Product
 * @package model
 */
class Product
{
    /** @var  $id int */
    private $id;
    /** @var  $name string */
    private $name;
    /** @var  $netPrice float */
    private $netPrice;
    /** @var  $tax float */
    private $tax;
    /** @var  $grossPrice float */
    private $grossPrice;
    /** @var  $image string */
    private $image;
    /** @var  $color Color */
    private $color;

    /**
     * Product constructor.
     *
     * @param int $id
     * @param string $name
     * @param float $netPrice
     * @param float $tax
     * @param float $grossPrice
     * @param string $image
     * @param Color $color
     */
    public function __construct(int $id, string $name, float $netPrice, float $tax, float $grossPrice, string $image, Color $color)
    {
        $this->id = $id;
        $this->name = $name;
        $this->netPrice = $netPrice;
        $this->tax = $tax;
        $this->grossPrice = $grossPrice;
        $this->image = $image;
        $this->color = $color;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getNetPrice(): float
    {
        return $this->netPrice;
    }

    /**
     * @param float $netPrice
     */
    public function setNetPrice(float $netPrice)
    {
        $this->netPrice = $netPrice;
    }

    /**
     * @return float
     */
    public function getTax(): float
    {
        return $this->tax;
    }

    /**
     * @param float $tax
     */
    public function setTax(float $tax)
    {
        $this->tax = $tax;
    }

    /**
     * @return float
     */
    public function getGrossPrice(): float
    {
        return $this->grossPrice;
    }

    /**
     * @param float $grossPrice
     */
    public function setGrossPrice(float $grossPrice)
    {
        $this->grossPrice = $grossPrice;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image)
    {
        $this->image = $image;
    }

    /**
     * @return Color
     */
    public function getColor(): Color
    {
        return $this->color;
    }

    /**
     * @param Color $color
     */
    public function setColor(Color $color)
    {
        $this->color = $color;
    }



}