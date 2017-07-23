<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle\ReadModel;


use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use ShopBundle\ReadModel\CartItem;
use ShopBundle\ReadModel\Product;

class CartItemTest extends TestCase
{
    private $product;

    public function setUp()
    {
        $price = new Money(10000, new Currency('PLN'));

        $productData = [
            'id' => 1,
            'name' => 'Test product',
            'tax' => [
                'name' => 'Tax',
                'rate' => 23.00,
            ],
            'category' => [
                'name' => 'Category',
            ],
        ];

        $this->product = new Product($productData, $price);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateWithWrongQty()
    {
        new CartItem($this->product, -1);
    }

    public function testCartItem()
    {
        $cartItem = new CartItem($this->product, 2);
        $total = new Money(20000, new Currency('PLN'));
        $totalWithTax = new Money(24600, new Currency('PLN'));

        $this->assertEquals(2, $cartItem->getQty());
        $this->assertEquals($this->product, $cartItem->getProduct());

        $this->assertEquals($total, $cartItem->getLineTotal());
        $this->assertEquals($totalWithTax, $cartItem->getLineTotalWithTax());
    }
}