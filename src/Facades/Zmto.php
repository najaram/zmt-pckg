<?php

namespace Najaram\Zmto\Facades;

use Illuminate\Support\Facades\Facade;

class Zmto extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'zmto';
    }
}
