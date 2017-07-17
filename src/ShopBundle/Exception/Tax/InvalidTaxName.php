<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Exception\Tax;

class InvalidTaxName extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct("Invalid tax name!");
    }
}