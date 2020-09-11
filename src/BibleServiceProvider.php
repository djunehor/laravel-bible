<?php

namespace Djunehor\Logos;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class BibleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Filesystem $filesystem
     * @return void
     */
    public function boot(Filesystem $filesystem)
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('laravel-bible', function () {
            return new Bible();
        });
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides(): array
    {
        return ['laravel-bible'];
    }
}
