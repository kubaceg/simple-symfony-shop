<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Service\Cart;


use Doctrine\Common\Collections\ArrayCollection;
use ShopBundle\Entity\CartItem;

interface CartInterface
{
    public function addProductToCart(CartItem $item);

    public function removeProductFromCart(int $productId);

    public function removeProductsFromCart(array $productIds);

    public function getCartProducts(): ArrayCollection;

    public function countProductsInCart(): int;

    public function updateProductQty(int $productId, int $qty);
}