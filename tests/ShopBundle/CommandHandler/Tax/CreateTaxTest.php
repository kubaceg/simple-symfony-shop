<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle\CommandHandler\Tax;

use PHPUnit\Framework\TestCase;
use ShopBundle\Command\Tax\CreateTaxCommand;
use ShopBundle\CommandHandler\Tax\CreateTax;
use ShopBundle\Entity\Tax;
use ShopBundle\Repository\Tax\TaxRepositoryInterface;


class CreateTaxTest extends TestCase
{
    const TEST_TAX_NAME = 'Test tax';
    const TEST_TAX_RATE = 25;
    private $taxRepo;
    private $taxModel;

    public function setUp()
    {
        $this->taxRepo = $this->getMockBuilder(TaxRepositoryInterface::class)
            ->setMethods(['save', 'findByName', 'findByRate'])
            ->getMock();

        $this->taxModel = new Tax(self::TEST_TAX_NAME, self::TEST_TAX_RATE);
    }

    public function testCreateTax()
    {
        $command = new CreateTaxCommand(self::TEST_TAX_NAME, self::TEST_TAX_RATE);

        $this->taxRepo->method('save')
            ->with($this->taxModel);

        $commandHandler = new CreateTax($this->taxRepo);
        $taxModel = $commandHandler->handle($command);

        $this->assertInstanceOf(Tax::class, $taxModel);
        $this->assertEquals($taxModel->getName(), self::TEST_TAX_NAME);
        $this->assertEquals($taxModel->getRate(), self::TEST_TAX_RATE);
    }

    /**
     * @expectedException ShopBundle\Exception\Tax\TaxExistsException
     */
    public function testCreateExistingCategory()
    {
        $command = new CreateTaxCommand(self::TEST_TAX_NAME, self::TEST_TAX_RATE);

        $this->taxRepo->method('findByName')
            ->with(self::TEST_TAX_NAME)
            ->willReturn($this->taxModel);

        $commandHandler = new CreateTax($this->taxRepo);
        $commandHandler->handle($command);
    }
}