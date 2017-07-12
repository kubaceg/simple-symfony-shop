<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\CommandHandler\Category;


use ShopBundle\Command\Category\CategoryCommand;
use ShopBundle\Entity\Category;
use ShopBundle\Exception\Category\CategoryExistsException;
use ShopBundle\Repository\Category\CategoryRepositoryInterface;

class CreateCategory
{
    private $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(CategoryCommand $command): Category
    {
        $categoryExists = $this->repository->findByName($command->getName());
        if ($categoryExists !== null) {
            throw new CategoryExistsException();
        }

        $category = new Category($command->getName());

        $this->repository->save($category);

        return $category;
    }
}