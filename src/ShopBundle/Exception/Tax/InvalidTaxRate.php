<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Exception\Tax;

class InvalidTaxRate extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct("Invalid tax rate!");
    }
}