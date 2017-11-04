<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\CommandHandler\Product;


use ShopBundle\Command\Product\ProductCommand;
use ShopBundle\Entity\Product;
use ShopBundle\Exception\Product\ProductExistsException;
use ShopBundle\Repository\Product\ProductRepositoryInterface;

class CreateProduct
{
    /** @var ProductRepositoryInterface */
    private $repository;

    /**
     * @param ProductRepositoryInterface $repository
     */
    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ProductCommand $command
     */
    public function handle(ProductCommand $command): void
    {
        $productExists = $this->repository->findByName($command->getName());
        if ($productExists !== null) {
            throw new ProductExistsException();
        }

        $formattedPrice = $this->convertPriceToInteger($command->getPrice());

        $product = new Product($command->getName(), $formattedPrice, $command->getTax(), $command->getCategory());

        $this->repository->save($product);
    }

    /**
     * @param float
     *
     * @return int
     */
    private function convertPriceToInteger(float $price): int
    {
        return intval(bcmul($price, 100, 0));
    }
}
