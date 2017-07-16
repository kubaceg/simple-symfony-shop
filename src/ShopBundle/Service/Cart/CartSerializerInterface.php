<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Service\Cart;


interface CartSerializerInterface
{
    public function serialize(array $data): string;

    public function deserialize(string $data): array;
}