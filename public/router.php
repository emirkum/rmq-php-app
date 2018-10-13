<?php

$loader = require __DIR__ . '/../../vendor/autoload.php';
$loader->addPsr4('RMQPHP\\', __DIR__);

/**
 * Requests entrance
 */

use RMQPHP\App\Router;
use RMQPHP\App\Exceptions\UnsupportedRequestType;
use RMQPHP\App\Validators\Validate;

$router = new Router();
$router->setRequest(new \RMQPHP\App\Http\Request());

$input = $router->getRequest()->post();

if (Validate::requestInput($input)) {

    $route = $input->route;

    /**
     * Build controller and action method to call
     */
    switch ($route) {
        case 'sendPayment':
            $controller = 'PaymentController';
            break;
        default:
            die('Invalid controller.');
    }

    /**
     * Process route
     */
    try {
        $router->route($controller . '@' . $route, $input->body);
    } catch (\RMQPHP\App\Exceptions\InvalidRouterPattern $e) {
        die($e->getMessage());
    } catch (\RMQPHP\App\Exceptions\UnknownActionMethod $e) {
        die($e->getMessage());
    } catch (\RMQPHP\App\Exceptions\UnknownController $e) {
        die($e->getMessage());
    }
    // example what it looks like at the end: $router->route('PaymentController@sendPayment', $input);
} else {
    die("Invalid request!");
}

