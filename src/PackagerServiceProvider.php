<?php

namespace TheGeekEngineer\Packager;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

/**
 * This is the service provider.
 *
 * Place the line below in the providers array inside app/config/app.php
 * <code>'TheGeekEngineer\Packager\PackagerServiceProvider',</code>
 *
 * @author TheGeekEngineer
 **/
class PackagerServiceProvider extends ServiceProvider
{
    /**
     * The console commands.
     *
     * @var bool
     */
    protected $commands = [
        'TheGeekEngineer\Packager\Commands\NewPackage',
        'TheGeekEngineer\Packager\Commands\RemovePackage',
        'TheGeekEngineer\Packager\Commands\GetPackage',
        'TheGeekEngineer\Packager\Commands\GitPackage',
        'TheGeekEngineer\Packager\Commands\ListPackages',
        'TheGeekEngineer\Packager\Commands\MoveTests',
        'TheGeekEngineer\Packager\Commands\CheckPackage',
        'TheGeekEngineer\Packager\Commands\PublishPackage',
        'TheGeekEngineer\Packager\Commands\EnablePackage',
        'TheGeekEngineer\Packager\Commands\DisablePackage',
    ];

    /**
     * Bootstrap the application events.
     *
     * @throws BindingResolutionException
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/packager.php' => config_path('packager.php'),
        ]);
    }

    /**
     * Register the command.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/packager.php', 'packager');

        $this->commands($this->commands);
    }
}
