<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace UI\UIHtmlBundle\Model;


use Doctrine\Common\Collections\ArrayCollection;

class CartItems
{
    private $items;

    public function __construct(array $items)
    {
        $this->items = new ArrayCollection($items);
    }

    /**
     * @return ArrayCollection
     */
    public function getItems(): ArrayCollection
    {
        return $this->items;
    }
}