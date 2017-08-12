<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\QueryHandler;


use ShopBundle\Factory\ProductReadModelFactory;
use ShopBundle\Query\AllProductsQuery;
use ShopBundle\Repository\Product\ProductRepositoryInterface;

class AllProducts
{
    /** @var ProductRepositoryInterface */
    private $repository;
    private $productFactory;

    public function __construct(ProductRepositoryInterface $repository, ProductReadModelFactory $productFactory)
    {
        $this->repository = $repository;
        $this->productFactory = $productFactory;
    }

    /**
     * @param AllProductsQuery $query
     * @return array
     */
    public function handle(AllProductsQuery $query)
    {
        $productsArray = [];
        $result = $this->repository->findAllProducts($query->getPage(), $query->getLimit());

        foreach ($result as $item) {
            $productsArray[] = $this->productFactory->get($item);
        }

        return $productsArray;
    }
}