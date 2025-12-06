<?php

namespace AichaDigital\LarabillFilament\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AichaDigital\LarabillFilament\LarabillFilament
 */
class LarabillFilament extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \AichaDigital\LarabillFilament\LarabillFilament::class;
    }
}
