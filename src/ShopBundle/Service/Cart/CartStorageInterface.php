<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Service\Cart;

use ShopBundle\Entity\Cart;

interface CartStorageInterface
{
    public function saveCart(Cart $cart);

    public function getCart(): Cart;
}