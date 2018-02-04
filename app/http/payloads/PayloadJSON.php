<?php
declare(strict_types=1);

namespace RMQPHP\App\Http\Payloads;

use RMQPHP\App\Http\Payload;

class PayloadJSON implements Payload {

    /**
     * @var string  Payload JSON string to send
     */
    private $payload;

    /**
     * Payload constructor
     */
    public function __construct() {
        // code
    }

    /**
     * @param   mixed   Payload to encode
     * @return  Payload
     */
    public function encode($payload) : Payload {
        $p = json_encode($payload);

        $this->setPayload($p);

        return $this;
    }

    /**
     * @return string
     */
    public function __toString() : string {
        return $this->getPayload();
    }

    /**
     * @return string
     */
    public function getPayload(): string {
        return $this->payload;
    }

    /**
     * @param string $payload
     */
    public function setPayload(string $payload): void {
        $this->payload = $payload;
    }
}