<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use ShopBundle\CommandHandler\Product\CreateProduct;
use ShopBundle\Entity\Category;
use ShopBundle\Entity\Product;
use ShopBundle\Entity\Tax;

class CreateTestProducts extends AbstractFixture implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tax1 = $manager->getRepository(Tax::class)->findByName(CreateProducts::TEST_TAX_1_NAME);
        $category1 = $manager->getRepository(Category::class)->findByName(CreateProducts::TEST_CATEGORY_1_NAME);
        $faker = Factory::create();
        for($i = 0; $i < 30; $i++) {
            $product = new Product($faker->sentence(3), $faker->numberBetween(100, 100000), $tax1, $category1);
            $manager->persist($product);
        }

        $manager->flush();
    }
}