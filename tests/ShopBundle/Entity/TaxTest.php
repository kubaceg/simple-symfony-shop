<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle\Entity;

use PHPUnit\Framework\TestCase;
use ShopBundle\Entity\Tax;

class TaxTest extends TestCase
{
    public function testTaxCreate()
    {
        $taxName = "Tax";
        $taxRate = 0.23;

        $tax = new Tax($taxName, $taxRate);

        $this->assertEquals($taxName, $tax->getName());
        $this->assertEquals($taxRate, $tax->getRate());
    }

    /**
     * @expectedException ShopBundle\Exception\Tax\InvalidTaxRate
     */
    public function testCreateTaxWithInvalidTaxRate()
    {
        new Tax("Tax", -0.23);
    }

    /**
     * @expectedException ShopBundle\Exception\Tax\InvalidTaxName
     */
    public function testCreateTaxWithInvalidTaxName()
    {
        new Tax("", 0.23);
    }
}