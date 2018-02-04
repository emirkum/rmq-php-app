<?php
declare(strict_types=1);

namespace RMQPHP\App\Entity;


class Currency
{
    /**
     * EUR is only available currency
     */
    const CURRENCY = "EUR";

    /**
     * Cent factor for EUR
     */
    const CENTFACTOR = 100;

    /**
     * @var int
     */
    private $centFactor;

    /**
     * @var string
     */
    private $stringRepresentation;

    /**
     * Currency constructor.
     * @param int $centFactor
     * @param string $stringRepresentation
     */
    public function __construct(int $centFactor, string $stringRepresentation) {
        $this->centFactor = $centFactor;
        $this->stringRepresentation = $stringRepresentation;
    }

    /**
     * @return int
     */
    public function getCentFactor(): int {
        return $this->centFactor;
    }

    /**
     * @return string
     */
    public function getStringRepresentation(): string {
        return $this->stringRepresentation;
    }

    /**
     * Validate currency
     */
    public function validateCurrency(){
        if($this->getStringRepresentation() != self::CURRENCY && $this->getCentFactor() != self::CENTFACTOR){
            $this->stringRepresentation = self::CURRENCY;
            $this->centFactor = self::CENTFACTOR;
        }
        return $this;
    }

}