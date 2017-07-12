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

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get rate
     *
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }
}

