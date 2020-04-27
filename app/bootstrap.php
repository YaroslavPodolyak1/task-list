<?php
session_start();

use App\Core\AppLoader;

class Loader
{
    public static function launch()
    {
        AppLoader::init();
        AppLoader::$kernel->launch();

    }
}

