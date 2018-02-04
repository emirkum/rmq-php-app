<?php
declare(strict_types=1);

namespace RMQPHP\Http\Payloads;


use RMQPHP\App\Http\Payload;

class PayloadXML implements Payload {

    /**
     * @param  mixed        Payload to encode
     * @return Payload
     */
    function encode($payload): Payload {
        // TODO: Implement encode() method.
    }

    /**
     * @return string   String representation of payload
     */
    function __toString(): string {
        // TODO: Implement __toString() method.
    }
}