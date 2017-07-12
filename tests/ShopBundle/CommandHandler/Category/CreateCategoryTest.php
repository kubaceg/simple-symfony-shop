<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle\CommandHandler\Category;

use PHPUnit\Framework\TestCase;
use ShopBundle\Command\Category\CategoryCommand;
use ShopBundle\CommandHandler\Category\CreateCategory;
use ShopBundle\Entity\Category;
use ShopBundle\Repository\Category\CategoryRepositoryInterface;

class CreateCategoryTest extends TestCase
{
    const TEST_CATEGORY_NAME = 'Test category';
    private $categoryRepo;
    private $categoryModel;

    public function setUp()
    {
        $this->categoryRepo = $this->getMockBuilder(CategoryRepositoryInterface::class)
            ->setMethods(['save', 'findById', 'findByName'])
            ->getMock();

        $this->categoryModel = new Category(self::TEST_CATEGORY_NAME);
    }

    public function testCreateCategory()
    {
        $command = new CategoryCommand(self::TEST_CATEGORY_NAME);

        $this->categoryRepo->method('save')
            ->with($this->categoryModel);

        $commandHandler = new CreateCategory($this->categoryRepo);
        $categoryModel = $commandHandler->handle($command);

        $this->assertEquals($categoryModel->getName(), self::TEST_CATEGORY_NAME);
    }

    /**
     * @expectedException ShopBundle\Exception\Category\CategoryExistsException
     */
    public function testCreateExistingCategory()
    {
        $command = new CategoryCommand(self::TEST_CATEGORY_NAME);

        $this->categoryRepo->method('findByName')
            ->with(self::TEST_CATEGORY_NAME)
            ->willReturn($this->categoryModel);

        $commandHandler = new CreateCategory($this->categoryRepo);
        $commandHandler->handle($command);
    }
}