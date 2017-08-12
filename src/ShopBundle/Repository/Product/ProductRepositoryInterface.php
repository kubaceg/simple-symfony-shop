<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Repository\Product;


use ShopBundle\Entity\Product;

interface ProductRepositoryInterface
{
    public function save(Product $product): void;

    public function findByName(string $name): ?Product;

    public function findAllProducts(int $page, int $limit): array;
}