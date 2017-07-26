<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Service\Cart;


use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Serializer;

class JMSCartSerializer implements CartSerializerInterface
{
    /** @var Serializer */
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function serialize(ArrayCollection $data): string
    {
        return $this->serializer->serialize($data, 'json');
    }

    public function deserialize(string $data): ArrayCollection
    {
        return new ArrayCollection($this->serializer->deserialize($data, 'ArrayCollection<int, ShopBundle\Entity\CartItem>', 'json'));
    }
}