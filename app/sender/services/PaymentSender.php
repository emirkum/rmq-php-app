<?php
declare(strict_types=1);

namespace RMQPHP\App\Sender\Services;

use RMQPHP\App\Http\Payloads\PayloadJSON;
use RMQPHP\App\Entity\Payment;
use RMQPHP\app\sender\amqp\RMQ;
use RMQPHP\App\Sender\ISender;

/**
 * Payment sender
 */
class PaymentSender implements ISender
{

    /**
     * @var Payment
     */
    private $payment;

    /**
     * @var \RMQPHP\App\Http\Payload
     */
    private $payload;

    /**
     * @var bool
     */
    private $sent = false;

    /**
     * Initialize values
     */
    public function __construct() {
        // code
    }

    /**
     * Sends a payment generation task to the workers
     */
    public function process() : void {
        if ($this->payment == null) return;

        $this->payload = new PayloadJSON();
        $this->payload->encode($this->payment);

        $amqp = new RMQ();

        if ($amqp->setupConn()) {
            $msg = $amqp->sendMsg($this->payload);

            $amqp->closeStream();

            echo('Message sent: '), $msg->body, "\n";

            $this->setSent(true);
        }
    }

    /**
     * @return Payment
     */
    public function getPayment(): Payment {
        return $this->payment;
    }

    /**
     * @param Payment $payment
     */
    public function setPayment(Payment $payment): void {
        $this->payment = $payment;
    }

    /**
     * @return bool
     */
    public function isSent(): bool {
        return $this->sent;
    }

    /**
     * @param bool $sent
     */
    public function setSent(bool $sent): void {
        $this->sent = $sent;
    }
}