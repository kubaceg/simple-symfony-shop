<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Command\Product;


use ShopBundle\Entity\Category;
use ShopBundle\Entity\Tax;

class ProductCommand
{
    /** @var string */
    private $name;

    /** @var float */
    private $price;

    /** @var Tax */
    private $tax;

    /** @var Category */
    private $category;

    public function __construct(string $name, float $price, Tax $tax, Category $category)
    {
        $this->name = $name;
        $this->price = $price;
        $this->tax = $tax;
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float|int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return Tax
     */
    public function getTax(): Tax
    {
        return $this->tax;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }
}