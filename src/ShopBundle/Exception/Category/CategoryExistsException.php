<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Exception\Category;

class CategoryExistsException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Category with such name exists!");
    }
}