<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace Tests\ShopBundle;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class TestBase extends WebTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->loadFixtures([
            'ShopBundle\DataFixtures\ORM\CreateCategories',
        ]);
    }
}