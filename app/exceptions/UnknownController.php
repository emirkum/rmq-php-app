<?php
declare(strict_types=1);

namespace RMQPHP\App\Exceptions;

use Exception;
use Throwable;

class UnknownController extends Exception {

    /**
     * @var string  Message to show
     */
    private $msg;

    /**
     * UnknownController constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null) {

        if ($message == "") {
            $this->msg = $this->getCustomMessage();
        } else {
            $this->msg = $message;
        }
        parent::__construct($this->msg, $code, $previous);
    }

    /**
     * @return string   Custom message to show
     */
    private function getCustomMessage() : string {
        return "Controller could not be found!";
    }
}