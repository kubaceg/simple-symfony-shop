<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle\Entity;


use PHPUnit\Framework\TestCase;
use ShopBundle\Entity\Category;
use ShopBundle\Entity\Product;
use ShopBundle\Entity\Tax;

class ProductTest extends TestCase
{
    private $category;
    private $tax;

    public function setUp()
    {
        $this->category = new Category("Test");
        $this->tax = new Tax("Tax", 23);
    }

    public function testProductCreate()
    {
        $product = new Product("Name", 1000, $this->tax, $this->category);

        $this->assertInstanceOf(Product::class, $product);
    }

    /**
     * @expectedException ShopBundle\Exception\Product\InvalidProductName
     */
    public function testWrongProductName()
    {
        new Product("", 1000, $this->tax, $this->category);
    }

    /**
     * @expectedException ShopBundle\Exception\Product\InvalidProductPrice
     */
    public function testWrongProductPrice()
    {
        new Product("Name", -1000, $this->tax, $this->category);

    }
}