<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Exception\Product;


class InvalidProductName extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct("Invalid product name!");
    }
}