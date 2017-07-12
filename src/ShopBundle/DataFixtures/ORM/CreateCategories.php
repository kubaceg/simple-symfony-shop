<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ShopBundle\Entity\Category;

class CreateCategories extends AbstractFixture implements FixtureInterface
{
    const TEST_CATEGORY_NAME = "Test category";

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $category = new Category(self::TEST_CATEGORY_NAME);

        $manager->persist($category);
        $manager->flush();
    }
}