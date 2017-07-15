<?php
declare(strict_types=1);

namespace ShopBundle\Entity;

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
        $this->name = $name;
        $this->price = $price;
        $this->tax = $tax;
        $this->category = $category;
    }
}

