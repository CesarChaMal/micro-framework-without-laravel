<?php


namespace IziDev\MiniFramework\Boot;

use Illuminate\Database\Capsule\Manager as Capsule;

class DataBase
{
    public function __invoke()
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => $_SERVER['DB_CONNECTION'],
            'host' => $_SERVER['DB_HOST'],
            'database' => $_SERVER['DB_DATABASE'],
            'username' => $_SERVER['DB_USERNAME'],
            'password' => $_SERVER['DB_PASSWORD'] ?: "",
            'port' => $_SERVER['DB_PORT'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        $capsule->setAsGlobal();

        $capsule->bootEloquent();
    }
}