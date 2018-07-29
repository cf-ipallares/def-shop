<?php

$product = $basketItem->getProduct();
$id = $product->getId();
$name = $product->getName();
$image = $product->getImage();
$netPrice = $product->getNetPrice();
$grossPrice = $product->getGrossPrice();
$colorName = $product->getColor()->getName();
$productCtr = $basketItem->getCtr();

?>

<tr>
    <td><img src="<?php echo $image ?>" class="def-shop-basket-product"/></td>
    <td><?php echo $name ?></td>
    <td><?php echo $netPrice ?>€</td>
    <td><?php echo $grossPrice ?>€</td>
    <td><?php echo $colorName ?></td>
    <td><?php echo $productCtr ?></td>
</tr>