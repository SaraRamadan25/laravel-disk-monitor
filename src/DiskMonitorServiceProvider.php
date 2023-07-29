<?php

namespace Spatie\LaravelDiskMonitor;

use Illuminate\Support\Facades\Route;
use Spatie\LaravelDiskMonitor\Commands\RecordDiskMetricsCommand;
use Spatie\LaravelDiskMonitor\HTTP\Controllers\DiskMetricsController;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DiskMonitorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-disk-monitor')
            ->hasViews()
            ->hasConfigFile()
            ->hasMigration('create_disk_monitor_tables')
            ->hasCommand(RecordDiskMetricsCommand::class);
    }

    public function packageRegistered()
    {
        Route::macro('diskMonitor', function (string $prefix) {
            Route::prefix($prefix)->group(function () {
                Route::get('/', DiskMetricsController::class);
            });
        });
    }
}
