<?php

namespace Aleex1848\UispLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class UispLaravel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'uisp-laravel';
    }
}
