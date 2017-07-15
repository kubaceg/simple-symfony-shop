<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle\ReadModel;

use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use ShopBundle\ReadModel\Product;

class ProductTest extends TestCase
{
    public function testProductReadModel()
    {
        $price = new Money(10000, new Currency('PLN'));
        $priceWithTax = new Money(12300, new Currency('PLN'));

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

        $readModel = new Product($productData, $price);

        $this->assertEquals(1, $readModel->getId());
        $this->assertEquals('Test product', $readModel->getName());
        $this->assertEquals('Tax', $readModel->getTaxName());
        $this->assertEquals(23.00, $readModel->getTaxRate());
        $this->assertEquals('Category', $readModel->getCategoryName());
        $this->assertEquals($price, $readModel->getPrice());
        $this->assertEquals($priceWithTax, $readModel->getPriceWithTax());
    }
}