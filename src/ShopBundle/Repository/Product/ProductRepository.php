<?php
declare(strict_types=1);

namespace ShopBundle\Repository\Product;

use Doctrine\ORM\EntityRepository;
use ShopBundle\Entity\Product;

class ProductRepository extends EntityRepository
{
    public function save(Product $product) {
        $this->_em->persist($product);
        $this->_em->flush();
    }
}
