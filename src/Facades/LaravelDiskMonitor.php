<?php

namespace Spatie\LaravelDiskMonitor\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Spatie\LaravelDiskMonitor\LaravelDiskMonitor
 */
class LaravelDiskMonitor extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Spatie\LaravelDiskMonitor\LaravelDiskMonitor::class;
    }
}
