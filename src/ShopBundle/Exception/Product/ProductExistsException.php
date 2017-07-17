<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Exception\Product;


class ProductExistsException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Product with such name exists!");
    }
}