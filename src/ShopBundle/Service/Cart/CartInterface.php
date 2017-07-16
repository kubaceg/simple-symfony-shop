<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Service\Cart;


use ShopBundle\ReadModel\Product;

interface CartInterface
{
    public function addProductToCart(Product $product);

    public function removeProductFromCart(int $productId);

    public function getCartProducts(): array;

    public function countProductsInCart(): int;
}