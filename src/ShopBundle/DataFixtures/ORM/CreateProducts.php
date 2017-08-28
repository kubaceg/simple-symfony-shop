<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ShopBundle\Entity\Category;
use ShopBundle\Entity\Product;
use ShopBundle\Entity\Tax;

class CreateProducts extends AbstractFixture implements FixtureInterface
{
    const TEST_PRODUCT_1_NAME = "Product 1";
    const TEST_PRODUCT_2_NAME = "Product 2";
    const TEST_PRODUCT_1_PRICE = 10000;
    const TEST_PRODUCT_2_PRICE = 20000;
    const TEST_CATEGORY_1_NAME = "Product category 1";
    const TEST_CATEGORY_2_NAME = "Product category 2";
    const TEST_TAX_1_NAME = "Tax 1";
    const TEST_TAX_2_NAME = "Tax 2";
    const TEST_TAX_1_RATE = 20;
    const TEST_TAX_2_RATE = 10;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tax1 = new Tax(self::TEST_TAX_1_NAME, self::TEST_TAX_1_RATE);
        $tax2 = new Tax(self::TEST_TAX_2_NAME, self::TEST_TAX_2_RATE);
        $category1 = new Category(self::TEST_CATEGORY_1_NAME);
        $category2 = new Category(self::TEST_CATEGORY_2_NAME);

        $manager->persist($tax1);
        $manager->persist($tax2);
        $manager->persist($category1);
        $manager->persist($category2);
        $manager->flush();

        $product1 = new Product(self::TEST_PRODUCT_1_NAME, self::TEST_PRODUCT_1_PRICE, $tax1, $category1);
        $product2 = new Product(self::TEST_PRODUCT_2_NAME, self::TEST_PRODUCT_2_PRICE, $tax2, $category2);

        $manager->persist($product1);
        $manager->persist($product2);

        $manager->flush();
    }
}