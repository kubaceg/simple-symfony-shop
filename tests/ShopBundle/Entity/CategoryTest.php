<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle\Entity;


use PHPUnit\Framework\TestCase;
use ShopBundle\Entity\Category;

class CategoryTest extends TestCase
{
    public function testCategory()
    {
        $categoryName = "Category";
        $category = new Category($categoryName);

        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals($categoryName, $category->getName());
    }

    /**
     * @expectedException ShopBundle\Exception\Category\InvalidCategoryName
     */
    public function testWringCategoryName()
    {
        new Category("");
    }
}