<?php

namespace App\Core;

use InvalidRouteException;
use Throwable;

class AppLoader
{

    public static $router;

    public static $db;

    public static $kernel;

    public static function init()
    {
        spl_autoload_register(['static', 'loadClass']);
        static::bootstrap();
        set_exception_handler(function (Throwable $e) {
            if ($e instanceof InvalidRouteException) {
                echo static::$kernel->launchAction('ErrorController', 'error404', [$e]);
            } else {
                echo static::$kernel->launchAction('ErrorController', 'error500', [$e]);
            }
        });
    }

    public static function bootstrap()
    {
        static::$router = new Router();
        static::$kernel = new Kernel();
        static::$db = new DatabaseConnection();
    }

    public static function loadClass($className)
    {
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        require_once ROOTPATH . '/app/Core' . DIRECTORY_SEPARATOR . $className . '.php';
    }

}