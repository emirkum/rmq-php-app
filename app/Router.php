<?php
declare(strict_types=1);

namespace RMQPHP\App;

use RMQPHP\App\Controllers\Controller;
use Exception;
use RMQPHP\App\Exceptions\InvalidRouterPattern;
use RMQPHP\App\Exceptions\UnknownActionMethod;
use RMQPHP\App\Exceptions\UnknownController;
use RMQPHP\App\Exceptions\UnsupportedRequestType;
use RMQPHP\App\Http\InputDecoder;
use RMQPHP\App\Http\Request;

/**
 * Main Router class used to process routing/requests
 */
class Router {

    /**
     * @var string
     */
    private const ROUTE_DELIMITER = "@";

    /**
     * @var string Controller's name to be created
     */
    private $ctrl;

    /**
     * @var Controller  Instance
     */
    private $controllerInstance;

    /**
     * Controller's action method to call
     * @var string
     */
    private $action;

    /**
     * @var Request
     */
    private $request;

    private $controllerNamespace = Controller::NS;

    /**
     * Router constructor
     */
    public function __construct() {

    }

    /**
     * Parse route and process it
     *
     * @param  string $pattern Route pattern ('SomeController@someAction')
     * @param  \stdClass $body Request's input
     * @throws InvalidRouterPattern
     * @throws UnknownController
     * @throws UnknownActionMethod
     */
    public function route(string $pattern, \stdClass $body): void {
        $pattern = explode(self::ROUTE_DELIMITER, $pattern);

        if (isset($pattern[0]) && isset($pattern[1])) {
            $this->setCtrl($this->getControllerNamespace() . $pattern[0]);
            $this->setAction($pattern[1]);

            $this->setControllerInstance($this->getCtrl());

            $this->callControllerAction($this->getControllerInstance(), $this->getAction(), $body);
        } else {
            throw new InvalidRouterPattern();
        }
    }

    /**
     * @return string
     */
    public function getCtrl(): string {
        return $this->ctrl;
    }

    /**
     * @param string $ctrl
     */
    public function setCtrl(string $ctrl): void {
        $this->ctrl = $ctrl;
    }

    /**
     * @return Controller
     */
    public function getControllerInstance(): Controller {
        return $this->controllerInstance;
    }

    /**
     * @param string $ctrl
     * @throws UnknownController
     */
    public function setControllerInstance(string $ctrl): void {
        if (!class_exists($ctrl)) throw new UnknownController();

        $this->controllerInstance = new $ctrl;
    }

    /**
     * @return string
     */
    public function getAction(): string {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action): void {
        $this->action = $action;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request) : void {
        $this->request = $request;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request {
        return $this->request;
    }

    /**
     * Attempt to call controller's action method
     *
     * @param Controller $controller
     * @param string $action
     * @param $params
     * @throws UnknownActionMethod
     */
    public function callControllerAction(Controller $controller, string $action, $params) : void {
        if (!method_exists($controller, $action)) throw new UnknownActionMethod();

        call_user_func_array(
            [$controller, $action],
            [$params]
        );
    }

    /**
     * @return string
     */
    public function getControllerNamespace(): string {
        return $this->controllerNamespace;
    }

    /**
     * @param string $controllerNamespace
     */
    public function setControllerNamespace(string $controllerNamespace): void {
        $this->controllerNamespace = $controllerNamespace;
    }
}
