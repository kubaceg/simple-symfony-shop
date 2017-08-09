<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use ShopBundle\Entity\Cart;

class CartTest extends TestCase
{
    private $populatedArrayCollection;

    public function setUp()
    {
        $this->populatedArrayCollection = new ArrayCollection(["item1", "item2"]);
    }

    public function testEmptyCart()
    {
        $cart = new Cart();

        $this->assertInstanceOf(ArrayCollection::class, $cart->getItems());
        $this->assertEquals(new ArrayCollection(), $cart->getItems());
        $this->assertEquals(0, $cart->countItems());
        $this->assertTrue($cart->isEmpty());
    }

    public function testNonEmptyCart()
    {
        $cart = new Cart($this->populatedArrayCollection);

        $this->assertInstanceOf(ArrayCollection::class, $cart->getItems());
        $this->assertEquals($this->populatedArrayCollection, $cart->getItems());
        $this->assertEquals(2, $cart->countItems());
        $this->assertFalse($cart->isEmpty());
    }
}