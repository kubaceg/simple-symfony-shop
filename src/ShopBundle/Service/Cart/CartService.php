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
        $items = $cart->getItems();
        if ($existingItem = $items->get($item->getProduct()->getId())) {
            $newQty = $existingItem->getQty() + $item->getQty();
            $item = new CartItem($item->getProduct(), $newQty);
        }
        $items->set($item->getProduct()->getId(), $item);
        $cart->setItems($items);

        $this->cartStorage->saveCart($cart);
    }

    public function removeProductFromCart(int $productId)
    {
        $this->removeProductsFromCart([$productId]);
    }

    public function removeProductsFromCart(array $productIds)
    {
        $cart = $this->cartStorage->getCart();
        $items = $cart->getItems();
        foreach ($productIds as $productId) {
            $items->remove($productId);
            $cart->setItems($items);
        }

        $this->cartStorage->saveCart($cart);
    }

    public function getCartProducts(): ArrayCollection
    {
        return $this->cartStorage->getCart()->getItems();
    }

    public function countProductsInCart(): int
    {
        return count($this->cartStorage->getCart()->getItems());
    }

    public function updateProductQty(int $productId, int $qty)
    {
        $cart = $this->cartStorage->getCart();
        $items = $cart->getItems();
        if($item = $items->get($productId)) {
            $item = new CartItem($item->getProduct(), $qty);
            $items->set($productId, $item);
            $cart->setItems($items);
            $this->cartStorage->saveCart($cart);
        }
    }
}