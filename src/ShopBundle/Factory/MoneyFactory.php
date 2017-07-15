<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\Factory;

use Money\Currency;
use Money\Money;

class MoneyFactory
{
    /** @var string */
    private $currencyCode;

    public function __construct(string $currencyCode)
    {
        if (empty($currencyCode)) {
            throw new \InvalidArgumentException("Currency code can't be empty");
        }

        $this->currencyCode = $currencyCode;
    }

    public function get(int $amount): Money
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException("Wrong amount");
        }

        return new Money($amount, new Currency($this->currencyCode));
    }
}