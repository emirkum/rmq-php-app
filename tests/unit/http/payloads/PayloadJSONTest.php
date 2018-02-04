<?php
declare(strict_types=1);

namespace RMQPHP\Tests\Unit\Http\Payloads;

use PHPUnit\Framework\TestCase;
use RMQPHP\App\Http\Payloads\PayloadJSON;

class PayloadJSONTest extends TestCase {

    /**
     * @test
     */
    public function encode_whenValidInput_thenInputShouldBeConvertedToValidStringRepresentation() : void {
        // given
        $encoder = new PayloadJSON();

        $input = new \stdClass();
        $input->amount = 100;
        $input->currency = "EUR";

        // when
        $encoded = $encoder->encode($input);

        // then
        $expectedOutput = '{"amount":100,"currency":"EUR"}';

        $this->assertEquals($expectedOutput, $encoded);
    }

    /**
     * @test
     */
    public function encode_whenEmptyObjectInput_thenReturnEmptyObject() : void {
        // given
        $encoder = new PayloadJSON();

        $input = new \stdClass();

        // when
        $encoded = $encoder->encode($input);

        // then
        $expectedOutput = "{}";

        $this->assertEquals($expectedOutput, $encoded);
    }

    /**
     * @test
     */
    public function encode_whenEmptyArrayInput_thenReturnEmptyArray() : void {
        // given
        $encoder = new PayloadJSON();

        $input = [];

        // when
        $encoded = $encoder->encode($input);

        // then
        $expectedOutput = "[]";

        $this->assertEquals($expectedOutput, $encoded);
    }
}