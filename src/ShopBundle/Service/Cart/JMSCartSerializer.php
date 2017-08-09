<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Service\Cart;


use JMS\Serializer\Serializer;
use ShopBundle\Entity\Cart;

class JMSCartSerializer implements CartSerializerInterface
{
    /** @var Serializer */
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function serialize(Cart $data): string
    {
        return $this->serializer->serialize($data, 'json');
    }

    public function deserialize(string $data): Cart
    {
        return $this->serializer->deserialize($data, '      ShopBundle\Entity\Cart', 'json');
    }
}