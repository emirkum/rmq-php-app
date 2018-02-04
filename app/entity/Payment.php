<?php
declare(strict_types=1);

namespace RMQPHP\App\Entity;

class Payment {

    /**
     * @var int Amount to process
     */
    public $amount;

    /**
     * @var string  Currency to use
     */
    public $currency;

    /**
     * Initialize values
     */
    public function __construct() {
        // code
    }

    /**
     * @return int
     */
    public function getAmount(): int {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void {
        $this->currency = $currency;
    }
}