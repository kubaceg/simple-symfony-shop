<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Repository\Tax;

use ShopBundle\Entity\Tax;

interface TaxRepositoryInterface
{
    public function save(Tax $tax): void;

    public function findByName(string $name): ?Tax;

    public function findByRate(float $rate): ?Tax;
}