<?php
declare(strict_types=1);

namespace RMQPHP\App\Controllers;

/**
 * Base class for all controllers
 */
abstract class Controller {
    /**
     * Namespace for all controllers
     * @var string
     */
    const NS = 'RMQPHP\App\Controllers\\';

    /**
     * Input data
     *
     * @var \stdClass
     */
    private $body;

    /**
     * @return \stdClass
     */
    public function getBody(): \stdClass {
        return $this->body;
    }

    /**
     * @param \stdClass $body
     */
    public function setBody(\stdClass $body): void {
        $this->body = $body;
    }
}