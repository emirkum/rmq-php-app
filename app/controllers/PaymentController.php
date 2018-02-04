<?php
declare(strict_types=1);

namespace RMQPHP\App\Controllers;

use RMQPHP\App\Entity\Currency;
use RMQPHP\App\Entity\Money;
use RMQPHP\App\Sender\ISender;
use RMQPHP\App\Sender\Services\PaymentSender;
use RMQPHP\App\Entity\Payment;

/**
 * Process requests to RMQPHP\Sender\Services\PaymentSender service
 * These methods are called in RMQPHP\Router
 */
class PaymentController extends Controller {

    /**
     * @var ISender
     */
    private $sender;

    /**
     * Create required service(s) to call its functions|methods
     */
    public function __construct() {
        $this->sender = new PaymentSender();
    }

    /**
     * Process payment
     *
     * @param \stdClass $body
     */
    public function sendPayment(\stdClass $body): void {
        if (isset($body->amount) && isset($body->currency)) {
            $currency = new Currency(100, $body->currency);
            $money = new Money($body->amount, $currency);

            $amount = $money->getAmount();

            $payment = new Payment();
            $payment->setAmount($amount);
            $payment->setCurrency($currency->getStringRepresentation());

            $this->sender->setPayment($payment);

            $this->sender->process();
        }
    }
}
