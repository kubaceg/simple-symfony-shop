<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ShopBundle\Entity\Tax;

class CreateTax extends AbstractFixture implements FixtureInterface
{
    const TEST_TAX_NAME = "Test tax rate";
    const TEST_TAX_RATE = 23;


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tax = new Tax(self::TEST_TAX_NAME, self::TEST_TAX_RATE);

        $manager->persist($tax);
        $manager->flush();
    }
}