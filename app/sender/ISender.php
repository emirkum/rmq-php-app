<?php
declare(strict_types=1);
namespace RMQPHP\App\Sender;

/**
 * Contract for all senders
 */
interface ISender {

    /**
     * Process http to Worker
     */
    public function process() : void;
}