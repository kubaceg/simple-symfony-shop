<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Service\Cart;

use ShopBundle\Entity\Cart;

interface CartSerializerInterface
{
    public function serialize(Cart $data): string;

    public function deserialize(string $data): Cart;
}