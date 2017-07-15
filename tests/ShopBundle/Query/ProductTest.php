<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle\Query;

use ShopBundle\Entity\Category;
use ShopBundle\ReadModel\Product;
use Tests\ShopBundle\TestBase;
use ShopBundle\DataFixtures\ORM\CreateProducts;

class ProductTest extends TestBase
{
    /** @var \ShopBundle\Query\Product */
    private $productQuery;

    public function setUp()
    {
        $this->productQuery = $this->getContainer()->get('shop.product_query');
    }

    public function testGetProductById()
    {
        $product = $this->productQuery->getProductById(1);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals(CreateProducts::TEST_PRODUCT_1_NAME, $product->getName());
        $this->assertEquals(CreateProducts::TEST_CATEGORY_1_NAME, $product->getCategoryName());
        $this->assertEquals(CreateProducts::TEST_TAX_1_NAME, $product->getTaxName());
        $this->assertEquals(CreateProducts::TEST_TAX_1_RATE, $product->getTaxRate());
    }

    public function testGetProductByName()
    {
        $product = $this->productQuery->getProductByName(CreateProducts::TEST_PRODUCT_2_NAME);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals(CreateProducts::TEST_PRODUCT_2_NAME, $product->getName());
        $this->assertEquals(CreateProducts::TEST_CATEGORY_2_NAME, $product->getCategoryName());
        $this->assertEquals(CreateProducts::TEST_TAX_2_NAME, $product->getTaxName());
        $this->assertEquals(CreateProducts::TEST_TAX_2_RATE, $product->getTaxRate());
    }

    public function testGetAllProducts()
    {
        $products = $this->productQuery->getAllProducts();

        $this->assertInternalType('array', $products);
        $this->assertCount(2, $products);
        $this->assertEquals(CreateProducts::TEST_PRODUCT_1_NAME, $products[0]->getName());
        $this->assertEquals(CreateProducts::TEST_PRODUCT_2_NAME, $products[1]->getName());
    }

    public function testGetProductsFromCategory()
    {
        $category = new Category(CreateProducts::TEST_CATEGORY_1_NAME);
        $products = $this->productQuery->getProductsByCategory($category);

        $this->assertInternalType('array', $products);
        $this->assertCount(1, $products);
        $this->assertEquals(CreateProducts::TEST_PRODUCT_1_NAME, $products[0]->getName());
    }
}