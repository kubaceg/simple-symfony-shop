<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Service\Cart;


use Doctrine\Common\Collections\ArrayCollection;
use ShopBundle\Entity\Cart;
use Symfony\Component\HttpFoundation\Session\Session;

class SessionCartStorage implements CartStorageInterface
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

    public function saveCart(Cart $cart)
    {
        $cart = $this->serializer->serialize($cart);
        $this->session->set($this->cartSessionKey, $cart);
    }

    public function getCart(): Cart
    {
        $cart = $this->session->get($this->cartSessionKey);

        if (is_null($cart)) {
            return new Cart();
        }

        return $this->serializer->deserialize($cart);
    }
}