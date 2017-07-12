<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\CommandHandler\Tax;


use ShopBundle\Command\Tax\CreateTaxCommand;
use ShopBundle\Entity\Tax;
use ShopBundle\Exception\Tax\TaxExistsException;
use ShopBundle\Repository\Tax\TaxRepositoryInterface;

class CreateTax
{
    private $repository;

    public function __construct(TaxRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(CreateTaxCommand $command): Tax
    {
        $taxExists = $this->repository->findByName($command->getName());
        if ($taxExists !== null) {
            throw new TaxExistsException();
        }

        $tax = new Tax($command->getName(), $command->getRate());

        $this->repository->save($tax);

        return $tax;
    }
}