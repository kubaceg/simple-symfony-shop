<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\ReadModel;

use Money\Money;

class Product
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var Money */
    private $price;

    /** @var string */
    private $taxName;

    /** @var float */
    private $taxRate;

    /** @var string */
    private $categoryName;

    public function __construct(array $data, Money $price)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->taxName = $data['tax']['name'];
        $this->taxRate = $data['tax']['rate'];
        $this->categoryName = $data['category']['name'];

        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function getPriceWithTax(): Money
    {
        return $this->getPrice()->multiply(($this->taxRate / 100) + 1);
    }

    public function getTaxName(): string
    {
        return $this->taxName;
    }

    public function getTaxRate(): float
    {
        return $this->taxRate;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }
}