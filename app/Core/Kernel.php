<?php

namespace App\Core;

use InvalidRouteException;

class Kernel
{
    public $defaultControllerName = 'MainController';

    public $defaultActionName = "index";

    public function launch()
    {

        list($controllerName, $actionName, $params) = AppLoader::$router->resolve();

        echo $this->launchAction($controllerName, $actionName, $params);
    }

    public function launchAction($controllerName, $actionName, $params)
    {
        $controllerName = empty($controllerName) ? $this->defaultControllerName : ucfirst($controllerName) . 'Controller';

        if (! file_exists(ROOTPATH . '/app/' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . $controllerName . '.php')) {
            throw new InvalidRouteException();
        }
        require_once ROOTPATH . '/app/' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . $controllerName . '.php';

        if (! class_exists("App\\Controllers\\" . ucfirst($controllerName))) {
            throw new InvalidRouteException();
        }
        $controllerName = "App\\Controllers\\" . ucfirst($controllerName);
        $controller = new $controllerName;
        $actionName = empty($actionName) ? $this->defaultActionName : $actionName;
        if (! method_exists($controller, $actionName)) {
            throw new InvalidRouteException();
        }

        return $controller->$actionName($params);
    }
}