<?php

namespace ShopBundle\Repository\Category;

use Doctrine\ORM\EntityRepository;
use ShopBundle\Entity\Category;

class CategoryRepository extends EntityRepository implements CategoryRepositoryInterface
{
    public function findById(int $id): ?Category
    {
        $qb = $this->_em->createQueryBuilder()
            ->select('c')
            ->from("ShopBundle:Category", 'c')
            ->where('c.id = :id');

        $qb->setParameter('id', (string)$id);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findByName(string $name): ?Category
    {
        $qb = $this->_em->createQueryBuilder()
            ->select('c')
            ->from("ShopBundle:Category", 'c')
            ->where('c.name = :name');

        $qb->setParameter('name', (string)$name);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function save(Category $category): void
    {
        $this->_em->persist($category);
        $this->_em->flush();
    }
}
