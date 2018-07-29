<?php

namespace services;

use exceptions\ServerErrorException;
use exceptions\UnauthorizedAccessException;
use model\Color;
use model\Product;

class ORMService extends Service
{
    public function convertProducts(array $productTRS, array $colors) : array {
        /** @var array $products */
        $products = [];
        foreach($productTRS as $productTR) {
            /** @var  $product Product */
            $product = $this->convertProduct($productTR, $colors);
            if(!$product) {
                throw new ServerErrorException('Inconsistence in DB for Products.');
            }
            $products[] = $product;
        }
        return $products;
    }

    public function convertProduct($colorTR, $colors) : Product {
        /** @var  $product Product */
        $product = null;
        if ($colorTR && isset($colorTR->id) && isset($colorTR->name) && isset($colorTR->net_price) && isset($colorTR->tax) && isset($colorTR->gross_price) && isset($colorTR->image) && isset($colorTR->color_fk)) {
            $color = $colors[$colorTR->color_fk];
            $product = new Product((int)$colorTR->id, $colorTR->name, (float)$colorTR->net_price, (float)$colorTR->tax, (float)$colorTR->gross_price, $colorTR->image, $color);
        }
        return $product;
    }

    public function convertColors(array $colorTRS) : array {
        /** @var  $colors array */
        $colors = [];
        foreach ($colorTRS as $colorTR) {
            /** @var  $color Color */
            $color = $this->convertColor($colorTR);
            if (!$color) {
                throw new ServerErrorException('Inconsistence in DB for Colors.');
            }
            $colors[$color->getId()] = $color;
        }

        return $colors;
    }

    private function convertColor($colorTR) {
        /** @var  $color Color */
        $color = null;
        if ($colorTR && isset($colorTR->id) && isset($colorTR->name)) {
            $color = new Color($colorTR->id, $colorTR->name);
        }
        return $color;
    }
}