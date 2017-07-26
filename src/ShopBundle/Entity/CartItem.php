<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Entity;

use Money\Money;
use ShopBundle\ReadModel\Product;

class CartItem
{
    /** @var int */
    private $qty;

    /** @var Product */
    private $product;

    public function __construct(Product $product, int $qty = 0)
    {
        if ($qty < 1) {
            throw new \InvalidArgumentException("Qty can't be less than 1");
        }

        $this->product = $product;
        $this->qty = $qty;
    }

    /**
     * @return int
     */
    public function getQty(): int
    {
        return $this->qty;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return Money
     */
    public function getLineTotal(): Money
    {
        return $this->product->getPrice()->multiply($this->qty);
    }

    /**
     * @return Money
     */
    public function getLineTotalWithTax(): Money
    {
        return $this->product->getPriceWithTax()->multiply($this->qty);
    }
}