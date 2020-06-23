<?php

use Illuminate\Http\Request;
use IziDev\Soap\Boot\Router;

function path($path)
{
    return Request::capture()->root() . $path;
}

function routes()
{
    return collect(Router::all())
        ->map(function ($route) {
            $route["full_path"] = Request::capture()->root() . $route["path"];

            return $route;
        })->pluck("full_path", "name");
}
