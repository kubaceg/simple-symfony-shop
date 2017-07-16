<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle\Service\Cart;


use Money\Currency;
use Money\Money;
use ShopBundle\ReadModel\Product;
use ShopBundle\Service\Cart\CartSerializerInterface;
use ShopBundle\Service\Cart\SessionCartService;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Tests\ShopBundle\TestBase;

class SessionCartServiceTest extends TestBase
{
    const CART_SESSION_KEY = 'cart';

    /** @var SessionCartService */
    private $cartService;

    /** @var CartSerializerInterface */
    private $cartSerializer;

    /** @var Session */
    private $session;

    /** @var Product */
    private $product;

    /** @var array */
    private $cartWithProduct;

    public function setUp()
    {
        $this->cartSerializer = $this->createMock(CartSerializerInterface::class);
        $this->session = new Session(new MockArraySessionStorage());

        $price = new Money(10000, new Currency('PLN'));
        $productData = [
            'id' => 1,
            'name' => 'Test product',
            'tax' => [
                'name' => 'Tax',
                'rate' => 23.00
            ],
            'category' => [
                'name' => 'Category'
            ]
        ];

        $this->product = new Product($productData, $price);
        $this->cartService = new SessionCartService($this->session, self::CART_SESSION_KEY, $this->cartSerializer);
        $this->cartWithProduct = [$this->product->getId() => $this->product];
    }

    public function tearDown()
    {
        unset($this->session);
        unset($this->cartSerializer);
    }

    public function testAddProductToCart()
    {
        $this->cartSerializer
            ->method('serialize')
            ->with($this->cartWithProduct)
            ->willReturn(json_encode($this->cartWithProduct));

        $this->assertNull($this->session->get(self::CART_SESSION_KEY));

        $this->cartService->addProductToCart($this->product);

        $cartFromSession = $this->session->get(self::CART_SESSION_KEY);
        $this->assertNotEmpty($cartFromSession);
        $this->assertEquals(json_encode($this->cartWithProduct), $cartFromSession);
    }

    public function testGetEmptyCart()
    {
        $this->assertInternalType('array', $this->cartService->getCartProducts());
        $this->assertEmpty($this->cartService->getCartProducts());
    }

    public function testGetCartProducts()
    {
        $this->cartSerializer
            ->method('deserialize')
            ->willReturn($this->cartWithProduct);
        $this->session->set(self::CART_SESSION_KEY, json_encode($this->cartWithProduct));

        $this->assertEquals($this->cartWithProduct, $this->cartService->getCartProducts());
    }

    public function testCountCartWithEmpty()
    {
        $this->assertEquals(0, $this->cartService->countProductsInCart());
    }

    public function testCountCartWithPopulatedCart()
    {
        $this->session->set(self::CART_SESSION_KEY, json_encode($this->cartWithProduct));
        $this->cartSerializer
            ->method('deserialize')
            ->willReturn($this->cartWithProduct);
        $this->assertEquals(1, $this->cartService->countProductsInCart());
    }

    public function testRemoveProductFromCart()
    {
        $this->cartSerializer
            ->method('deserialize')
            ->willReturn($this->cartWithProduct);
        $this->cartSerializer
            ->method('serialize')
            ->with([])
            ->willReturn(json_encode([]));

        $this->session->set(self::CART_SESSION_KEY, json_encode($this->cartWithProduct));

        $this->cartService->removeProductFromCart($this->product->getId());

        $this->assertEquals(json_encode([]), $this->session->get(self::CART_SESSION_KEY));
    }

    public function testRemoveNonExistingProductFromCart()
    {
        $this->cartSerializer
            ->method('deserialize')
            ->willReturn($this->cartWithProduct);
        $this->cartSerializer
            ->method('serialize')
            ->with($this->cartWithProduct)
            ->willReturn(json_encode($this->cartWithProduct));

        $this->session->set(self::CART_SESSION_KEY, json_encode($this->cartWithProduct));

        $this->cartService->removeProductFromCart(2);

        $this->assertEquals(json_encode($this->cartWithProduct), $this->session->get(self::CART_SESSION_KEY));
    }
}