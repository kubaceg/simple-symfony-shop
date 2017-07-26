<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Service\Cart;

use ShopBundle\Entity\CartItem;
use Symfony\Component\HttpFoundation\Session\Session;

class SessionCartService implements CartInterface
{
    /** @var Session */
    private $session;

    /** @var string */
    private $cartSessionKey;

    /** @var CartSerializerInterface */
    private $serializer;

    public function __construct(Session $session, string $cartSessionKey, CartSerializerInterface $serializer)
    {
        $this->session = $session;
        $this->cartSessionKey = $cartSessionKey;
        $this->serializer = $serializer;
    }

    public function addProductToCart(CartItem $item)
    {
        $cart = $this->getCartFromSession();
        $cart[] = $item;
        $this->saveCartInSession($cart);
    }

    public function removeProductFromCart(int $productId)
    {
        $this->removeProductsFromCart([$productId]);
    }

    public function removeProductsFromCart(array $productIds)
    {
        $cart = $this->getCartFromSession();
        foreach ($cart as $id => $cartItem) {
            if (in_array($cartItem->getProduct()->getId(), $productIds)) {
                unset($cart[$id]);
            }
        }

        $this->saveCartInSession($cart);
    }

    public function getCartProducts(): array
    {
        return $this->getCartFromSession();
    }

    public function countProductsInCart(): int
    {
        return count($this->getCartFromSession());
    }

    public function updateProductQty(int $productId, int $qty)
    {
        $cart = $this->getCartProducts();

        foreach ($cart as $id => $item) {
            if($id === $productId) {
                $cart[] = new CartItem($item->getProduct(), $qty);
                unset($cart[$id]);
            }
        }

        $this->saveCartInSession($cart);
    }

    private function getCartFromSession(): array
    {
        $cart = $this->session->get($this->cartSessionKey);

        if (is_null($cart)) {
            return [];
        }

        return $this->serializer->deserialize($cart);
    }

    private function saveCartInSession(array $cart)
    {
        $cart = $this->serializer->serialize($cart);
        $this->session->set($this->cartSessionKey, $cart);
    }
}