<?php
declare(strict_types=1);

namespace ShopBundle\Repository\Category;

use ShopBundle\Entity\Category;

/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */
interface CategoryRepositoryInterface
{
    public function findById(int $id): ?Category;

    public function findByName(string $name): ?Category;

    public function save(Category $category): void;
}