<?php
declare(strict_types=1);

namespace RMQPHP\App\Http;

use RMQPHP\App\Http\Decoders\InputDecoderJSON;
use RMQPHP\App\Exceptions\UnsupportedContentType;

class Request {

    /**
     * @var InputDecoder
     */
    private $decoder;

    /**
     * @var string
     */
    private $contentType;

    /**
     * Request constructor
     *
     * @throws \Exception
     */
    public function __construct() {
        $this->setContentType($_SERVER["CONTENT_TYPE"]);

        switch ($this->getContentType()) {
            case strpos($this->getContentType(),"application/json"):
            case strpos($this->getContentType(), "application/x-www-form-urlencoded"):
                $this->decoder = new InputDecoderJSON();
                break;
            default:
                throw new UnsupportedContentType();
        }
    }

    /**
     * @return \stdClass
     */
    public function post() : \stdClass {
        return $this->decoder->decode($_POST);
    }

    /**
     * @return \stdClass
     */
    public function get() : \stdClass {
        return $this->decoder->decode($_GET);
    }

    /**
     * Request content type
     *
     * @return string
     */
    public function getContentType() : string {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     */
    public function setContentType(string $contentType) : void {
        $this->contentType = $contentType;
    }

    /**
     * @param InputDecoder $decoder
     */
    public function setDecoder(InputDecoder $decoder) : void {
        $this->decoder = $decoder;
    }
}