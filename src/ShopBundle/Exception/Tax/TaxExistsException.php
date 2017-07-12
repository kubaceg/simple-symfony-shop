<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Exception\Tax;

class TaxExistsException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Tax with such name exists!");
    }
}