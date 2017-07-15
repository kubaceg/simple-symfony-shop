<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Query;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use ShopBundle\Entity\Category;
use ShopBundle\Factory\ProductReadModelFactory;
use ShopBundle\ReadModel\Product as ProductReadModel;

class Product
{
    /** @var EntityManager */
    private $em;
    /** @var ProductReadModelFactory */
    private $productFactory;

    public function __construct(EntityManager $em, ProductReadModelFactory $productFactory)
    {
        $this->em = $em;
        $this->productFactory = $productFactory;
    }

    private function getProductQueryBuilder()
    {
        return $this->em->createQueryBuilder()
            ->select('p', 't', 'c')
            ->from("ShopBundle:Product", 'p')
            ->leftJoin('p.tax', 't')
            ->leftJoin('p.category', 'c');
    }

    public function getProductById(int $id): ?ProductReadModel
    {
        $qb = $this->getProductQueryBuilder()
            ->where('p.id = :id');
        $qb->setParameter('id', $id);

        $result = $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);

        return $this->productFactory->get(reset($result));
    }

    public function getProductByName(string $name): ?ProductReadModel
    {
        $qb = $this->getProductQueryBuilder()
            ->where('p.name = :name');
        $qb->setParameter('name', $name);

        $result = $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);

        return $this->productFactory->get(reset($result));
    }

    public function getAllProducts(): array
    {
        $productsArray = [];
        $qb = $this->getProductQueryBuilder();

        $result = $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);

        foreach ($result as $item) {
            $productsArray[] = $this->productFactory->get($item);
        }

        return $productsArray;
    }

    public function getProductsByCategory(Category $category): array
    {
        $productsArray = [];
        $qb = $this->getProductQueryBuilder()
            ->where('c.name = :name');
        $qb->setParameter('name', $category->getName());


        $result = $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);

        foreach ($result as $item) {
            $productsArray[] = $this->productFactory->get($item);
        }

        return $productsArray;
    }
}