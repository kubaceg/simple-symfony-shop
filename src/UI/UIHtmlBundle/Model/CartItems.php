<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace UI\UIHtmlBundle\Model;


use Doctrine\Common\Collections\ArrayCollection;

class CartItems
{
    private $items;

    public function __construct(ArrayCollection $items)
    {
        $this->items = $items;
    }

    /**
     * @return ArrayCollection
     */
    public function getItems(): ArrayCollection
    {
        return $this->items;
    }
}