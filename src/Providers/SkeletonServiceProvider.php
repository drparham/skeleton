<?php

namespace Pta\Skeleton;

use Illuminate\Support\ServiceProvider;

class SkeletonServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // Publish config
            // $this->publishes([
            //     $this->getResourcePath('config/config.php') => config_path('werxe/skeleton/config.php'),
            // ], 'config');

            // Publish migrations
            // $this->publishes([
            //     $this->getResourcePath('migrations') => database_path('migrations'),
            // ], 'migrations');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->mergeConfigFrom(
            $this->getResourcePath('config/config.php'), 'werxe.skeleton.config'
        );

        $this->registerSkeleton();
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return [ 'skeleton' ];
    }

    /**
     * Registers Skeleton.
     *
     * @return void
     */
    protected function registerSkeleton()
    {
        $this->app->singleton('skeleton', function ($app) {
            return new Skeleton();
        });

        $this->app->alias('skeleton', 'Werxe\Skeleton\Skeleton');
    }

    /**
     * Returns the full path to the given resource.
     *
     * @param  string  $resource
     * @return string
     */
    protected function getResourcePath($resource)
    {
        return realpath(__DIR__.'/../resources/'.$resource);
    }
}


