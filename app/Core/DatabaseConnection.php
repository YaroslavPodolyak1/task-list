<?php

namespace App\Core;

use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseConnection
{
    public function __construct()
    {
        ['mysql' => $config] = require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/config/database.php');

        $capsule = new Capsule();

        $capsule->addConnection($config);

        $capsule->bootEloquent();
    }
}