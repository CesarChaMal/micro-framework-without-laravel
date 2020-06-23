<?php

namespace IziDev\Soap\Boot;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

class Blade
{
    public function __invoke($viewFile, $arguments)
    {
        // Configuration
        // Note that you can set several directories where your templates are located
        $pathsToTemplates = [__DIR__ . '/../../views'];
        $pathToCompiledTemplates = __DIR__ . '/../../' . 'compiled';

        // Dependencies
        $filesystem = new Filesystem();
        $eventDispatcher = new Dispatcher(new Container);

        // Create View Factory capable of rendering PHP and Blade templates
        $viewResolver = new EngineResolver;
        $bladeCompiler = new BladeCompiler($filesystem, $pathToCompiledTemplates);

        $viewResolver->register('blade', function () use ($bladeCompiler) {
            return new CompilerEngine($bladeCompiler);
        });

        $viewResolver->register('php', function () {
            return new PhpEngine;
        });

        $viewFinder = new FileViewFinder($filesystem, $pathsToTemplates);
        $viewFactory = new Factory($viewResolver, $viewFinder, $eventDispatcher);

        return $viewFactory->make($viewFile, $arguments)->render();
    }
}