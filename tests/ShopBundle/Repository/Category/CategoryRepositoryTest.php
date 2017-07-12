<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle\Repository\Category;

use ShopBundle\DataFixtures\ORM\CreateCategories;
use ShopBundle\Entity\Category;
use Tests\ShopBundle\TestBase;

class CategoryRepositoryTest extends TestBase
{
    private $repository;

    public function setUp()
    {
        parent::setUp();

        $this->repository = static::$kernel->getContainer()->get('shop.category_repository');
    }

    public function tearDown()
    {
        unset($this->repository);
    }

    public function testFindCategoryByName()
    {
        $category = $this->repository->findByName(CreateCategories::TEST_CATEGORY_NAME);

        $this->assertInstanceOf(Category::class, $category);
        $this->assertNotEmpty($category->getId());
        $this->assertEquals(CreateCategories::TEST_CATEGORY_NAME, $category->getName());
    }


    public function testCantFindCategoryByWrongName()
    {
        $category = $this->repository->findByName("Wrong name");

        $this->assertNull($category);
    }

    public function testFindCategoryById()
    {
        $category = $this->repository->findById(1);

        $this->assertInstanceOf(Category::class, $category);
        $this->assertNotEmpty($category->getId());
        $this->assertEquals(CreateCategories::TEST_CATEGORY_NAME, $category->getName());
    }

    public function testCantFindCategoryByWrongId()
    {
        $category = $this->repository->findById(123);

        $this->assertNull($category);
    }

    public function testSaveCategory()
    {
        $newCategoryName = "New category";
        $category = new Category($newCategoryName);

        $this->repository->save($category);

        $newCategory = $this->repository->findByName($newCategoryName);

        $this->assertInstanceOf(Category::class, $newCategory);
        $this->assertNotEmpty($category->getId());
        $this->assertEquals($newCategoryName, $newCategory->getName());
    }
}