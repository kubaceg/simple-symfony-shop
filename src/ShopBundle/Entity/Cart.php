<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class Cart
{
    /** @var ArrayCollection */
    private $items;

    public function __construct($items = null)
    {
        $this->items = $items;

        if (empty($items)) {
            $this->items = new ArrayCollection();
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getItems(): ArrayCollection
    {
        return $this->items;
    }

    /**
     * @param ArrayCollection $items
     */
    public function setItems(ArrayCollection $items)
    {
        $this->items = $items;
    }

    /**
     * @return int
     */
    public function countItems(): int
    {
        return count($this->items);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->items->getKeys());
    }
}