<?php

namespace Djunehor\Logos\Test;

use Djunehor\Logos\BibleServiceProvider;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Orchestra\Testbench\Concerns\CreatesApplication;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            BibleServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetup()
    {
    }
}
