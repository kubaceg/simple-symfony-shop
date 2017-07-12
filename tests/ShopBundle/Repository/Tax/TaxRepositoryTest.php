<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle\Repository\Tax;

use ShopBundle\DataFixtures\ORM\CreateTax;
use ShopBundle\Entity\Tax;
use Tests\ShopBundle\TestBase;

class TaxRepositoryTest extends TestBase
{
    private $repository;

    public function setUp()
    {
        parent::setUp();

        $this->repository = static::$kernel->getContainer()->get('shop.tax_repository');
    }

    public function tearDown()
    {
        unset($this->repository);
    }

    public function testFindTaxByName()
    {
        $tax = $this->repository->findByName(CreateTax::TEST_TAX_NAME);

        $this->assertInstanceOf(Tax::class, $tax);
        $this->assertNotEmpty($tax->getId());
        $this->assertEquals(CreateTax::TEST_TAX_NAME, $tax->getName());
        $this->assertEquals(CreateTax::TEST_TAX_RATE, $tax->getRate());
    }

    public function testCantFindTaxByWrongName()
    {
        $tax = $this->repository->findByName("Wrong name");

        $this->assertNull($tax);
    }

    public function testFindTaxByRate()
    {
        $tax = $this->repository->findByRate(CreateTax::TEST_TAX_RATE);

        $this->assertInstanceOf(Tax::class, $tax);
        $this->assertNotEmpty($tax->getId());
        $this->assertEquals(CreateTax::TEST_TAX_NAME, $tax->getName());
        $this->assertEquals(CreateTax::TEST_TAX_RATE, $tax->getRate());
    }

    public function testCantFindTaxByWrongRate()
    {
        $tax = $this->repository->findByRate(1);

        $this->assertNull($tax);
    }

    public function testSaveTax()
    {
        $newTaxName = "New tax";
        $newTaxRate = 29;
        $tax = new Tax($newTaxName, $newTaxRate);

        $this->repository->save($tax);

        $newTax = $this->repository->findByName($newTaxName);

        $this->assertInstanceOf(Tax::class, $newTax);
        $this->assertNotEmpty($newTax->getId());
        $this->assertEquals($newTaxName, $newTax->getName());
        $this->assertEquals($newTaxRate, $newTax->getRate());
    }
}