<?php
declare(strict_types=1);

namespace RMQPHP\Tests\Unit\Http\Validators;

use PHPUnit\Framework\TestCase;
use RMQPHP\App\Validators\Validate;

class ValidateTest extends TestCase {

    /**
     * @test
     */
    public function requestInput_whenValidInput_thenReturnTrue() : void {
        // given
        $input = new \stdClass();
        $input->body = "test_body";
        $input->route = "test_route";

        // when
        $valid = Validate::requestInput($input);

        // then
        $this->assertTrue($valid);
    }

    /**
     * @test
     */
    public function requestInput_whenInputEmptyObj_thenReturnFalse() : void {
        // given
        $input = new \stdClass();

        // when
        $valid = Validate::requestInput($input);

        // then
        $this->assertFalse($valid);
    }

    /**
     * @test
     */
    public function requestInput_whenInputEmptyArray_thenReturnFalse() : void {
        // given
        $input = [];

        // when
        $valid = Validate::requestInput($input);

        // then
        $this->assertFalse($valid);
    }
}