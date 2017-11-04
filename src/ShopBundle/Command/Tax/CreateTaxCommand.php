<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Command\Tax;

class CreateTaxCommand
{
    /** @var string */
    private $name;

    /** @var float */
    private $rate;

    public function __construct(string $name, float $rate)
    {
        $this->name = $name;
        $this->rate = $rate;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRate(): float
    {
        return $this->rate;
    }
}
