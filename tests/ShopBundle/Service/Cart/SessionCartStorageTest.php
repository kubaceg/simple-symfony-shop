<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle\Service\Cart;


use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use ShopBundle\Service\Cart\CartSerializerInterface;
use ShopBundle\Service\Cart\CartStorageInterface;
use ShopBundle\Service\Cart\SessionCartStorage;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

class SessionCartStorageTest extends TestCase
{
    const CART_SESSION_KEY = 'cart';

    /** @var CartSerializerInterface */
    private $cartSerializer;

    /** @var Session */
    private $session;

    /** @var CartStorageInterface */
    private $cartStorage;

    public function setUp()
    {
        $this->cartSerializer = $this->createMock(CartSerializerInterface::class);
        $this->session = new Session(new MockArraySessionStorage());
        $this->cartStorage = new SessionCartStorage($this->session, self::CART_SESSION_KEY, $this->cartSerializer);
    }

    public function testGetEmptyCartFromSession()
    {
        $this->session->set(self::CART_SESSION_KEY, null);

        $cart = $this->cartStorage->getCart();

        $this->assertInstanceOf(ArrayCollection::class, $cart);
        $this->assertTrue($cart->isEmpty());
    }

    public function testGetNonEmptyCartFromSession()
    {
        $cartArray = ["element1"];
        $this->session->set(self::CART_SESSION_KEY, json_encode($cartArray));

        $this->cartSerializer
            ->method('deserialize')
            ->with(json_encode($cartArray))
            ->willReturn(new ArrayCollection($cartArray));

        $cart = $this->cartStorage->getCart();

        $this->assertInstanceOf(ArrayCollection::class, $cart);
        $this->assertEquals(new ArrayCollection($cartArray), $cart);
    }

    public function testSaveCart()
    {
        $cart = new ArrayCollection(["element1"]);
        $serializedCart = json_encode($cart);
        $this->cartSerializer
            ->method('serialize')
            ->with($cart)
            ->willReturn($serializedCart);

        $this->assertNull($this->session->get(self::CART_SESSION_KEY));

        $this->cartStorage->saveCart($cart);

        $this->assertEquals($serializedCart, $this->session->get(self::CART_SESSION_KEY));
    }
}