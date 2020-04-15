<?php

namespace Djunehor\Logos;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
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
        $publishTag = 'laravel-bible';
        if (app() instanceof \Illuminate\Foundation\Application) {
            $this->publishes([
                __DIR__.'/config/laravel-bible.php' => config_path('laravel-bible.php'),
            ], $publishTag);

            $this->publishes([
                __DIR__.'/database/migrations/2019_11_22_145649_create_words_table.php.stub' => $this->getMigrationFileName($filesystem),
            ], $publishTag);

            $this->publishes([
                __DIR__.'/database/seeds/LaravelBibleSeeder.php.stub' => database_path('seeds/LaravelBibleSeeder.php'), ],
                $publishTag);
            $this->publishes([
                __DIR__.'/database/seeds/entries.csv.zip' => database_path('seeds/entries.csv.zip'), ],
                $publishTag);
        }
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

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @param Filesystem $filesystem
     * @return string
     */
    protected function getMigrationFileName(Filesystem $filesystem): string
    {
        $timestamp = date('Y_m_d_His');

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem) {
                return $filesystem->glob($path.'*_create_laravel_bible_table.php');
            })->push($this->app->databasePath()."/migrations/{$timestamp}_create_laravel_bible_table.php")
            ->first();
    }
}
