<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle\ReadModel;


use PHPUnit\Framework\TestCase;
use ShopBundle\ReadModel\PaginatedProducts;

class PaginatedProductsTest extends TestCase
{
    public function testPaginated()
    {
        $productsArray = [];
        $paginated = new PaginatedProducts($productsArray, 1, 6, 20);
        $this->assertEquals([], $paginated->getProducts());
        $this->assertEquals(1, $paginated->getPage());
        $this->assertEquals(6, $paginated->getLimit());
        $this->assertEquals(20, $paginated->getLastPage());
    }
}
