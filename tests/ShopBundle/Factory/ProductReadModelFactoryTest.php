<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle\Factory;


use PHPUnit\Framework\TestCase;
use ShopBundle\Factory\MoneyFactory;
use ShopBundle\Factory\ProductReadModelFactory;
use ShopBundle\ReadModel\Product;

class ProductReadModelFactoryTest extends TestCase
{
    public function testProductReadModelFactory()
    {
        $moneyFactory = new MoneyFactory("PLN");
        $moneyModel = $moneyFactory->get(1200);
        $productData = [
            "id" => 123,
            "name" => "Test",
            'price' => 1200,
            'tax' => [
                'id' => 1,
                'name' => 'Tax',
                'rate' => 23.00
            ],
            'category' => [
                'id' => 1,
                'name' => 'Category'
            ]
        ];

        $expectedModel = new Product($productData, $moneyModel);
        $productFactory = new ProductReadModelFactory($moneyFactory);
        $factoryModel = $productFactory->get($productData);

        $this->assertEquals($expectedModel, $factoryModel);
    }
}