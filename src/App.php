<?php

namespace IziDev\Soap;

class App
{
    public function runWeb()
    {
        $this->env();
        $this->database();
        $this->routes();
    }

    public function runMigration()
    {
        $this->env();
        $this->database();
        $this->loadMigrations();
    }

    private function routes()
    {
        (new Boot\Router)->__invoke();
    }

    private function env()
    {
        \Dotenv\Dotenv::createMutable(dirname(__DIR__))->load();
    }

    private function database()
    {
        (new Boot\DataBase)->__invoke();
    }

    private function loadMigrations()
    {
        require_once dirname(__DIR__) . "/migrations/db.php";
    }
}