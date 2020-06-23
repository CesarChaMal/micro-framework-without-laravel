<?php

namespace IziDev\Soap\Boot;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Str;

class Router
{

    /**
     * @var \Illuminate\Routing\Router
     */
    private $router;

    private function request()
    {
        return Request::capture();
    }

    private function route()
    {
        $container = new Container;

        $container->instance('Illuminate\Http\Request', $this->request());

        $events = new Dispatcher($container);

        $this->router = new \Illuminate\Routing\Router($events, $container);

        return $this->router;
    }

    private function dispatch()
    {
        $response = $this->router->dispatch($this->request());

        $response->send();
    }

    private function redirect()
    {
        $redirect = new Redirector(new UrlGenerator($this->router->getRoutes(), $this->request()));
    }

    public function __invoke()
    {
        $this->route();

        $this->redirect();

        $this->generateRoute();

        $this->dispatch();
    }

    private function generateRoute()
    {
        $routes = self::all();

        foreach ($routes as $route) {
            $this->router->addRoute($route['method'], $route["path"], $route["controller"])->name($route["name"]);
        }
    }

    public static function all()
    {
        $routes = include dirname(__DIR__) . "/../routes/web.php";

        $routes = collect($routes)->transform(function ($controller, $route)  {
            return [
                "name" => self::getNameRoute($route),
                "method" => self::getMethodRoute($controller),
                "controller" => $controller,
                "path" => $route
            ];
        })->values()->toArray();

        return $routes;
    }

    public static function getMethodRoute($controller)
    {
        $methods = [
            "Get",
            "Post",
            "Delete",
            "Put"
        ];

        $method = collect($methods)->filter(function ($value) use ($controller) {
            return strpos(class_basename($controller), $value) !== false;
        })->first();

        return method_exists(\Illuminate\Routing\Router::class, $method) ? [strtoupper($method)] : ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];
    }

    public static function getNameRoute($route)
    {
        return (string)Str::of($route)
            ->replace("/", ".")
            ->replace("-", ".")
            ->replaceFirst(".", "");
    }
}