<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Factory;

use ShopBundle\ReadModel\Product;

class ProductReadModelFactory
{
    /** @var MoneyFactory */
    private $moneyFactory;

    public function __construct(MoneyFactory $moneyFactory)
    {
        $this->moneyFactory = $moneyFactory;
    }

    public function get(array $productData): Product
    {
        $price = $this->moneyFactory->get($productData['price']);

        return new Product($productData, $price);
    }
}