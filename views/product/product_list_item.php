<?php

$id = $product->getId();
$name = $product->getName();
$netPrice = $product->getNetPrice();
$grossPrice = $product->getGrossPrice();
$colorName = $product->getColor()->getName();
$addToBasketUrl = $urlPrefix. "basket/add-product";

echo '        <tr>';
echo "            <td>$name</td>";
echo "            <td>$netPrice</td>";
echo "            <td>$grossPrice</td>";
echo "            <td>$colorName</td>";
echo '            <td class="action">';
echo "                <a href='#' class='add-to-basket' data-url='$addToBasketUrl' data-product-id='$id'><span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span></a>";
echo "            </td>";
echo '        </tr>';