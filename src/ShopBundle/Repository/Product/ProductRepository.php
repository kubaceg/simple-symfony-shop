<?php
declare(strict_types=1);

namespace ShopBundle\Repository\Product;

use Doctrine\ORM\EntityRepository;
use ShopBundle\Entity\Product;

class ProductRepository extends EntityRepository implements ProductRepositoryInterface
{
    public function save(Product $product): void
    {
        $this->_em->persist($product);
        $this->_em->flush();
    }

    public function findByName(string $name): ?Product
    {
        $qb = $this->_em->createQueryBuilder()
            ->select('p')
            ->from("ShopBundle:Product", 'p')
            ->where('p.name = :name');

        $qb->setParameter('name', (string)$name);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
