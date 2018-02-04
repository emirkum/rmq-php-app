<?php
declare(strict_types=1);

namespace RMQPHP\Tests\Unit;

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
     * @var Router
     */
    private $router;

    const FAKE_CONTROLLER_NAMESPACE = "RMQPHP\Tests\Fake\\";

    const FAKE_CONTROLLER = self::FAKE_CONTROLLER_NAMESPACE . "TestController";

    /**
     * @before
     */
    public function prepare() : void {
        $this->router = Mockery::mock(Router::class)->makePartial();
        $request = Mockery::mock(Request::class)->shouldReceive()->never()->getMock();

        $this->router->setRequest($request);
        $this->router->setControllerNamespace(self::FAKE_CONTROLLER_NAMESPACE);
    }

    /**
     * @after
     */
    public function cleanup() : void {
        Mockery::close();
    }

    /**
     * @test
     */
    public function route_whenControllerValid_thenControllerShouldBeInstantiated() {
        // given
        $this->assertNotNull($this->router->getRequest());
        $this->assertInstanceOf(Request::class, $this->router->getRequest());

        $data = new \stdClass();
        $data->data = "test";

        $this->router->shouldReceive("callControllerAction")->once()->with(self::FAKE_CONTROLLER, "testAction", $data);

        // when
        try {
            $this->router->route("TestController@testAction", $data);
        } catch (InvalidRouterPattern $e) {
            $this->fail($e->getMessage());
        } catch (UnknownActionMethod $e) {
            $this->fail($e->getMessage());
        } catch (UnknownController $e) {
            $this->fail($e->getMessage());
        }

        // then
        // controller successfully created
        $this->assertInstanceOf(Controller::class, $this->router->getControllerInstance());
    }

    /**
     * @test
     * @expectedException Exception
     * @throws InvalidRouterPattern
     * @throws \RMQPHP\App\Exceptions\UnknownController
     * @throws \RMQPHP\App\Exceptions\UnknownActionMethod
     */
    public function route_whenPatternNotParsable_thenThrowException() : void {
        // given
        $this->assertNotNull($this->router->getRequest());
        $this->assertInstanceOf(Request::class, $this->router->getRequest());

        // when
        $this->router->route("", new \stdClass());

        // then
        // Exception should be thrown by router
    }

    /**
     * @test
     * @expectedException Exception
     * @throws InvalidRouterPattern
     * @throws \RMQPHP\App\Exceptions\UnknownController
     * @throws \RMQPHP\App\Exceptions\UnknownActionMethod
     */
    public function route_whenInvalidController_thenThrowException() : void {
        // given
        $this->assertNotNull($this->router->getRequest());
        $this->assertInstanceOf(Request::class, $this->router->getRequest());

        // when
        $this->router->route("NonExistingController@nonExistingAction", new \stdClass());

        // then
        // Exception should be thrown by router
    }

    /**
     * @test
     * @expectedException Exception
     * @throws InvalidRouterPattern
     * @throws \RMQPHP\App\Exceptions\UnknownController
     * @throws \RMQPHP\App\Exceptions\UnknownActionMethod
     */
    public function route_whenInvalidControllerAction_thenThrowException() : void {
        // given
        $this->assertNotNull($this->router->getRequest());
        $this->assertInstanceOf(Request::class, $this->router->getRequest());

        // when
        $this->router->route("TestController@nonExistingAction", new \stdClass());

        // then
        // Exception should be thrown by router
    }
}