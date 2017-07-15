<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle\Factory;


use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use ShopBundle\Factory\MoneyFactory;

class MoneyFactoryTest extends TestCase
{
    public function testCreateMoney()
    {
        $money = new Money(1000, new Currency("PLN"));

        $factory = new MoneyFactory("PLN");
        $moneyFromFactory = $factory->get(1000);

        $this->assertEquals($money, $moneyFromFactory);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    function testCreateMoneyWithWrongAmount()
    {
        $factory = new MoneyFactory("PLN");
        $factory->get(-100);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    function testCreateMoneyWithEmptyCurrency()
    {
        $factory = new MoneyFactory("");
        $factory->get(100);
    }
}