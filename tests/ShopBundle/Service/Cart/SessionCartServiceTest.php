<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle\Service\Cart;


use Doctrine\Common\Collections\ArrayCollection;
use Money\Currency;
use Money\Money;
use ShopBundle\Entity\Cart;
use ShopBundle\Entity\CartItem;
use ShopBundle\ReadModel\Product;
use ShopBundle\Service\Cart\CartService;
use ShopBundle\Service\Cart\CartStorageInterface;
use ShopBundle\Service\Cart\SessionCartService;
use Tests\ShopBundle\TestBase;

class SessionCartServiceTest extends TestBase
{
    /** @var CartItem */
    private $cartItem;

    /** @var CartItem */
    private $cartItem2;

    /** @var ArrayCollection */
    private $cartWithProduct;

    /** @var ArrayCollection */
    private $cartWithBothProducts;

    /** @var CartStorageInterface */
    private $cartStorage;

    /** @var CartService */
    private $cartService;

    /** @var Cart */
    private $cart;

    public function setUp()
    {
        $price = new Money(10000, new Currency('PLN'));
        $productData = [
            'id' => 2,
            'name' => 'Test product',
            'tax' => [
                'name' => 'Tax',
                'rate' => 23.00,
            ],
            'category' => [
                'name' => 'Category',
            ],
        ];
        $productData2 = [
            'id' => 3,
            'name' => 'Test product3',
            'tax' => [
                'name' => 'Tax',
                'rate' => 23.00,
            ],
            'category' => [
                'name' => 'Category',
            ],
        ];

        $this->cartItem = new CartItem(new Product($productData, $price), 1);
        $this->cartItem2 = new CartItem(new Product($productData2, $price), 1);
        $this->cartStorage = $this->getMockBuilder(CartStorageInterface::class)->getMock();
        $this->cartWithProduct = new Cart(new ArrayCollection([2 => $this->cartItem]));
        $this->cartWithBothProducts = new Cart(new ArrayCollection([2 => $this->cartItem, 3 => $this->cartItem2]));
        $this->cartService = new CartService($this->cartStorage);
        $this->cart = new Cart();
    }

    public function tearDown()
    {
        unset($this->cartStorage);
    }

    public function testAddProductToCart()
    {
        $this->cartStorage
            ->expects($this->once())
            ->method('getCart')
            ->willReturn($this->cart);
        $this->cartStorage
            ->expects($this->once())
            ->method('saveCart')
            ->with($this->cartWithProduct);

        $this->cartService->addProductToCart($this->cartItem);

        $this->assertTrue(true);
    }

    public function testAddProductToNonEmptyCart()
    {
        $this->cartStorage
            ->expects($this->once())
            ->method('getCart')
            ->willReturn($this->cartWithProduct);
        $this->cartStorage
            ->expects($this->once())
            ->method('saveCart')
            ->with($this->cartWithBothProducts);

        $this->cartService->addProductToCart($this->cartItem2);

        $this->assertTrue(true);
    }

    public function testAddExistingProductToCart()
    {
        $cartItemWithIncrementedQty = new CartItem($this->cartItem->getProduct(), 2);
        $cartWithIncrementedQty = new Cart(new ArrayCollection([2 => $cartItemWithIncrementedQty, 3 => $this->cartItem2]));
        $this->cartStorage
            ->expects($this->once())
            ->method('getCart')
            ->willReturn($this->cartWithBothProducts);
        $this->cartStorage
            ->expects($this->once())
            ->method('saveCart')
            ->with($cartWithIncrementedQty);

        $this->cartService->addProductToCart($this->cartItem);

        $this->assertTrue(true);
    }

    public function testGetCartProducts()
    {
        $this->cartStorage
            ->expects($this->once())
            ->method('getCart')
            ->willReturn($this->cartWithProduct);

        $cart = $this->cartService->getCartProducts();

        $this->assertEquals($this->cartWithProduct->getItems(), $cart);
    }

    public function testGetCountProductsInCart()
    {
        $this->cartStorage
            ->expects($this->once())
            ->method('getCart')
            ->willReturn($this->cartWithProduct);

        $count = $this->cartService->countProductsInCart();

        $this->assertEquals($count, 1);
    }

    public function testRemoveProductFromCart()
    {
        $this->cartStorage
            ->expects($this->once())
            ->method('getCart')
            ->willReturn($this->cartWithBothProducts);
        $this->cartStorage
            ->expects($this->once())
            ->method('saveCart')
            ->with($this->cartWithProduct);

        $this->cartService->removeProductFromCart(3);

        $this->assertTrue(true);
    }

    public function testRemoveProductsFromCart()
    {
        $this->cartStorage
            ->expects($this->once())
            ->method('getCart')
            ->willReturn($this->cartWithBothProducts);
        $this->cartStorage
            ->expects($this->once())
            ->method('saveCart')
            ->with($this->cart);

        $this->cartService->removeProductsFromCart([2,3]);

        $this->assertTrue(true);
    }

    public function testUpdateExistingProductQty()
    {
        $cartItemWithIncrementedQty = new CartItem($this->cartItem->getProduct(), 5);
        $cartWithIncrementedQty = new Cart(new ArrayCollection([2 => $cartItemWithIncrementedQty]));

        $this->cartStorage
            ->expects($this->once())
            ->method('getCart')
            ->willReturn($this->cartWithProduct);
        $this->cartStorage
            ->expects($this->once())
            ->method('saveCart')
            ->with($cartWithIncrementedQty);

        $this->cartService->updateProductQty($cartItemWithIncrementedQty->getProduct()->getId(), 5);

        $this->assertTrue(true);
    }

    public function testUpdateNonExistingProductQty()
    {
        $this->cartStorage
            ->expects($this->once())
            ->method('getCart')
            ->willReturn($this->cartWithProduct);
        $this->cartStorage
            ->expects($this->never())
            ->method('saveCart');

        $this->cartService->updateProductQty(123, 5);

        $this->assertTrue(true);
    }
}