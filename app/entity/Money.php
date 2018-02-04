<?php
declare(strict_types=1);

namespace RMQPHP\App\Entity;


class Money
{
    /**
     * @var string
     */
    private $amount;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * Money constructor.
     * @param string $amount
     * @param Currency $currency
     */
    public function __construct(string $amount, Currency $currency) {
        $this->currency = $currency->validateCurrency();
        $this->amount = $this->convertToCents($amount);
    }

    /**
     * @param $amount
     * @return int
     */
    public function convertToCents($amount) : int {
        if(strpos($amount, '.')){
            $a = substr($amount, 0, (strpos($amount, '.')+ 3));
           return intval($this->currency->getCentFactor() * $a);
        }
        
        return intval($amount * $this->currency->getCentFactor());
    }

    /**
     * @return int
     */
    public function getAmount(): int {
        return $this->amount;
    }


}