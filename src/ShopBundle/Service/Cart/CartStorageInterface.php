<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Service\Cart;

use Doctrine\Common\Collections\ArrayCollection;

interface CartStorageInterface
{
    public function saveCart(ArrayCollection $cart);

    public function getCart(): ArrayCollection;
}