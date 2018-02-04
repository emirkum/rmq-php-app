<?php


namespace RMQPHP\Tests\fake;

use RMQPHP\App\Controllers\Controller;

class TestController extends Controller {

    /**
     * @var string
     */
    private $data;

    public function testAction(\stdClass $d) : void {
        $this->data = $d->data;
    }

    /**
     * @return string
     */
    public function getData(): string {
        return $this->data;
    }

    /**
     * @param string $data
     */
    public function setData(string $data): void {
        $this->data = $data;
    }
}