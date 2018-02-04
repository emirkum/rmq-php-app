<?php
declare(strict_types=1);

namespace RMQPHP\App\Sender;

use RMQPHP\App\Http\Payload;

interface AMQP
{
    /**
     * Setup connection
     */
    public function setupConn() : bool;

    /**
     * Send message
     * @param Payload   $payload
     * @returns bool
     */
    public function sendMsg(Payload $payload);

    /**
     * Close connection
     */
    public function closeStream() : void;

}