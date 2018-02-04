<?php
declare(strict_types=1);

namespace RMQPHP\App\Http\Decoders;

use RMQPHP\App\Exceptions\InvalidRequestInput;
use RMQPHP\App\Http\InputDecoder;

class InputDecoderJSON implements InputDecoder {

    /**
     * @param   mixed      Input to decode
     * @return  \stdClass
     * @throws InvalidRequestInput
     */
    function decode($input): \stdClass {
        $in = json_encode($input);

        $out = json_decode($in);

        if (!is_object($out) || (is_object($out) && !isset($out->body))) throw new InvalidRequestInput();

        return $out;
    }
}