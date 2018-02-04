<?php
declare(strict_types=1);

namespace RMQPHP\App\Http;

interface InputDecoder {

    /**
     * @param   mixed  Input to decode
     * @return  \stdClass
     */
    function decode($input) : \stdClass;
}