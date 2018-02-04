<?php
declare(strict_types=1);

namespace RMQPHP\Tests\Integration;

use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;
use RMQPHP\App\Controllers\Controller;
use RMQPHP\App\Exceptions\InvalidRouterPattern;
use RMQPHP\App\Exceptions\UnknownActionMethod;
use RMQPHP\App\Exceptions\UnknownController;
use RMQPHP\App\Http\Request;
use RMQPHP\App\Router;

class RouterTest extends TestCase {

    /**
     * @after
     */
    public function cleanup() : void {
        Mockery::close();
    }

    /**
     * @test
     */
    public function route_whenControllerValid_thenControllerActionShouldBeCalled() : void {
        // given
        $router = new Router();
        $request = Mockery::mock(Request::class)->shouldReceive()->never()->getMock();

        $router->setRequest($request);
        $router->setControllerNamespace("RMQPHP\Tests\Fake\\");

        $this->assertNotNull($router->getRequest());
        $this->assertInstanceOf(Request::class, $router->getRequest());

        $data = new \stdClass();
        $data->data = "test";

        // when
        try {
            $router->route("TestController@testAction", $data);
        } catch (InvalidRouterPattern $e) {
            $this->fail($e->getMessage());
        } catch (UnknownActionMethod $e) {
            $this->fail($e->getMessage());
        } catch (UnknownController $e) {
            $this->fail($e->getMessage());
        }

        // then
        // controller successfully created
        $this->assertInstanceOf(Controller::class, $router->getControllerInstance());

        // controller's action successfully called
        $this->assertNotNull($router->getControllerInstance()->getData());
        $this->assertEquals("test", $router->getControllerInstance()->getData());
    }
}