<?php
declare(strict_types=1);

namespace RMQPHP\Tests\Unit\Http\Decoders;

use PHPUnit\Framework\TestCase;
use RMQPHP\App\Http\Decoders\InputDecoderJSON;

class InputDecoderJSONTest extends TestCase {

    /**
     * @test
     * @throws \RMQPHP\App\Exceptions\InvalidRequestInput
     */
    public function decode_whenValidInputString_thenValidJsonOutput() : void {
        // given
        $decoder = new InputDecoderJSON();

        $input = $in = [];
        $in["amount"] = 100;
        $in["currency"] = "EUR";
        $input["body"] = $in;

        // when
        $output = $decoder->decode($input);

        // then
        $outputExpected = new \stdClass();
        $outputExpected->amount = 100;
        $outputExpected->currency = "EUR";

        $this->assertNotNull($output->body);

        $this->assertEquals($outputExpected, $output->body);
    }

    /**
     * @test
     * @expectedException \Exception
     * @throws \RMQPHP\App\Exceptions\InvalidRequestInput
     */
    public function decode_whenInputIsEmptyArray_thenThrowException() : void {
        // given
        $decoder = new InputDecoderJSON();

        $input = [];

        // when
        $decoder->decode($input);

        // then
        // Exception should be thrown
    }

    /**
     * @test
     * @expectedException \Exception
     * @throws \RMQPHP\App\Exceptions\InvalidRequestInput
     */
    public function decode_whenInputIsEmptyObj_thenThrowException() : void {
        // given
        $decoder = new InputDecoderJSON();

        $input = new \stdClass();

        // when
        $decoder->decode($input);

        // then
        // Exception should be thrown
    }
}