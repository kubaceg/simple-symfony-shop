<?php
declare(strict_types=1);

namespace ShopBundle\Entity;

use ShopBundle\Exception\Product\InvalidProductName;
use ShopBundle\Exception\Product\InvalidProductPrice;

/**
 * Product
 */
class Product
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var int */
    private $price;

    /** @var Tax */
    private $tax;

    /** @var Category */
    private $category;

    public function __construct(string $name, int $price, Tax $tax, Category $category)
    {
        if (empty($name)) {
            throw new InvalidProductName();
        }

        if ($price < 0) {
            throw new InvalidProductPrice();
        }

        $this->name = $name;
        $this->price = $price;
        $this->tax = $tax;
        $this->category = $category;
    }
}

