<?php
declare(strict_types=1);

namespace RMQPHP\Tests\Integration\Sender\Services;

use PHPUnit\Framework\TestCase;
use RMQPHP\App\Entity\Currency;
use RMQPHP\App\Entity\Money;
use RMQPHP\App\Entity\Payment;
use RMQPHP\App\Sender\Services\PaymentSender;

class PaymentSenderTest extends TestCase {

    /**
     * @test
     */
    public function process_whenValidPayment_thenProcessShouldBeSuccessful() : void {
        // given
        $currency = new Currency(100, "EUR");
        $money = new Money("50", $currency);

        $amount = $money->getAmount();

        $payment = new Payment();
        $payment->setAmount($amount);
        $payment->setCurrency($currency->getStringRepresentation());

        $sender = new PaymentSender();
        $sender->setPayment($payment);

        // when
        $sender->process();

        // then
        $this->assertTrue($sender->isSent());
    }

    /**
     * @test
     */
    public function process_whenPaymentNull_thenRejectProcess() : void {
        // given
        $sender = new PaymentSender();

        // when
        $sender->process();

        // then
        $this->assertFalse($sender->isSent());
    }
}