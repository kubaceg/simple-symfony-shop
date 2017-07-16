<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Service\Cart;

use ShopBundle\ReadModel\Product;
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

    public function addProductToCart(Product $product)
    {
        $cart = $this->getCartFromSession();
        $cart[$product->getId()] = $product;
        $this->saveCartInSession($cart);
    }

    public function removeProductFromCart(int $productId)
    {
        $cart = $this->getCartFromSession();
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $this->saveCartInSession($cart);
        }
    }

    public function getCartProducts(): array
    {
        return $this->getCartFromSession();
    }

    public function countProductsInCart(): int
    {
        return count($this->getCartFromSession());
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