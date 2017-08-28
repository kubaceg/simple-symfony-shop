<?php
declare(strict_types=1);

namespace ShopBundle\Repository\Product;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use ShopBundle\Entity\Product;
use ShopBundle\ReadModel\PaginatedProducts;

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

    public function findAllProducts(int $page, int $limit): PaginatedProducts
    {
        $qb =  $this->_em->createQueryBuilder()
            ->select('p', 't', 'c')
            ->from("ShopBundle:Product", 'p')
            ->leftJoin('p.tax', 't')
            ->leftJoin('p.category', 'c');

        $paginator = new Paginator($qb);
        $paginator->getQuery()
            ->setHydrationMode(Query::HYDRATE_ARRAY)
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        $pages = intval(ceil($paginator->count() / $limit));

        $productPaginator = new PaginatedProducts($paginator->getIterator()->getArrayCopy(), $page, $limit, $pages);

        return $productPaginator;
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