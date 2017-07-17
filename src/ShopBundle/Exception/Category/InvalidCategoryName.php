<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Exception\Category;


class InvalidCategoryName extends \Exception
{
    public function __construct()
{
    parent::__construct("Invalid category name!");
}
}