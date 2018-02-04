<?php
declare(strict_types=1);

namespace RMQPHP\App\Http;

interface Payload {

    /**
     * @param  mixed        Payload to encode
     * @return Payload
     */
    function encode($payload) : Payload;

    /**
     * @return string   String representation of payload to be sent
     */
    function __toString() : string;
}