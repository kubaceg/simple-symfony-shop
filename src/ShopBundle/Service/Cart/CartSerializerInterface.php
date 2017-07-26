<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Service\Cart;


use Doctrine\Common\Collections\ArrayCollection;

interface CartSerializerInterface
{
    public function serialize(ArrayCollection $data): string;

    public function deserialize(string $data): ArrayCollection;
}