<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace UIHtmlBundle\Twig;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;

class Price extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
        );
    }

    public function priceFilter(Money $price)
    {
        $currencies = new ISOCurrencies();

        $numberFormatter = new \NumberFormatter('pl_PL', \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

        return $moneyFormatter->format($price); // outputs $1.00
    }
}