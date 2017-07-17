<?php
declare(strict_types=1);

namespace ShopBundle\Entity;

use ShopBundle\Exception\Tax\InvalidTaxName;
use ShopBundle\Exception\Tax\InvalidTaxRate;

/**
 * Tax
 */
class Tax
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $rate;

    public function __construct(string $name, float $rate)
    {
        if(empty($name)) {
            throw new InvalidTaxName();
        }

        if ($rate < 0) {
            throw new InvalidTaxRate();
        }

        $this->name = $name;
        $this->rate = $rate;
    }

    public function getId(): int
    {
        return $this->id;
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

