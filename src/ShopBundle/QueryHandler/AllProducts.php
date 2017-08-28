<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\QueryHandler;


use ShopBundle\Factory\ProductReadModelFactory;
use ShopBundle\Query\AllProductsQuery;
use ShopBundle\ReadModel\PaginatedProducts;
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
     * @return PaginatedProducts
     */
    public function handle(AllProductsQuery $query): PaginatedProducts
    {
        $result = $this->repository->findAllProducts($query->getPage(), $query->getLimit());

        $products = [];
        foreach ($result->getProducts() as $item) {
            $products[] = $this->productFactory->get($item);
        }

        $paginated = new PaginatedProducts($products, $query->getPage(), $query->getLimit(), $result->getLastPage());

        return $paginated;
    }
}