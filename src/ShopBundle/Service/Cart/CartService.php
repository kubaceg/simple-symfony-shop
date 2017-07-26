<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Service\Cart;

use Doctrine\Common\Collections\ArrayCollection;
use ShopBundle\Entity\CartItem;

class CartService implements CartInterface
{
    /** @var CartStorageInterface */
    private $cartStorage;

    public function __construct(CartStorageInterface $storage)
    {
        $this->cartStorage = $storage;
    }

    public function addProductToCart(CartItem $item)
    {
        $cart = $this->getCartFromSession();

        $cart->set($item->getProduct()->getId(), $item);

        $this->saveCartInSession($cart);
    }

    public function removeProductFromCart(int $productId)
    {
        // TODO: Implement removeProductFromCart() method.
    }

    public function removeProductsFromCart(array $productIds)
    {
        // TODO: Implement removeProductsFromCart() method.
    }

    public function getCartProducts(): ArrayCollection
    {
        // TODO: Implement getCartProducts() method.
    }

    public function countProductsInCart(): int
    {
        // TODO: Implement countProductsInCart() method.
    }

    public function updateProductQty(int $productId, int $qty)
    {
        // TODO: Implement updateProductQty() method.
    }
}