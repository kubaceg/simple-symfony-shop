<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Service\Cart;


use JMS\Serializer\Serializer;

class JMSCartSerializer implements CartSerializerInterface
{
    /** @var Serializer */
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function serialize(array $data): string
    {
        return $this->serializer->serialize($data, 'json');
    }

    public function deserialize(string $data): array
    {
        return $this->serializer->deserialize($data, 'array<ShopBundle\ReadModel\CartItem>', 'json');
    }
}