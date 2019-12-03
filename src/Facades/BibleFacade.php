<?php

namespace Djunehor\Logos\Facades;

use Illuminate\Support\Facades\Facade;

class BibleFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-bible';
    }
}
