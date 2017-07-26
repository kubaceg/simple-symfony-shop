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
        $cart = $this->cartStorage->getCart();

        if ($existingItem = $cart->get($item->getProduct()->getId())) {
            $newQty = $existingItem->getQty() + $item->getQty();
            $item = new CartItem($item->getProduct(), $newQty);
        }
        $cart->set($item->getProduct()->getId(), $item);

        $this->cartStorage->saveCart($cart);
    }

    public function removeProductFromCart(int $productId)
    {
        $this->removeProductsFromCart([$productId]);
    }

    public function removeProductsFromCart(array $productIds)
    {
        $cart = $this->cartStorage->getCart();

        foreach ($productIds as $productId) {
            $cart->remove($productId);
        }

        $this->cartStorage->saveCart($cart);
    }

    public function getCartProducts(): ArrayCollection
    {
        return $this->cartStorage->getCart();
    }

    public function countProductsInCart(): int
    {
        return count($this->cartStorage->getCart());
    }

    public function updateProductQty(int $productId, int $qty)
    {
        $cart = $this->cartStorage->getCart();

        if($item = $cart->get($productId)) {
            $item = new CartItem($item->getProduct(), $qty);
            $cart->set($productId, $item);
            $this->cartStorage->saveCart($cart);
        }
    }
}