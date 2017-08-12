<?php
declare(strict_types=1);

namespace ShopBundle\Repository\Product;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
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

    public function findAllProducts(int $page, int $limit): array
    {
        $qb =  $this->_em->createQueryBuilder()
            ->select('p', 't', 'c')
            ->from("ShopBundle:Product", 'p')
            ->leftJoin('p.tax', 't')
            ->leftJoin('p.category', 'c')
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);


        return $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);
    }

    public function countPages($limit): int
    {
        $products = $this->_em->createQueryBuilder()
            ->select('count(p.id)')
            ->from("ShopBundle:Product", 'p')
            ->getQuery()
            ->getSingleScalarResult();

        return intval(ceil($products/$limit));
    }
}