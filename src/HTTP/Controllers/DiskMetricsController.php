<?php

namespace Spatie\LaravelDiskMonitor\HTTP\Controllers;

use Spatie\LaravelDiskMonitor\Models\DiskMonitorEntry;

class DiskMetricsController
{
    public function __invoke()
    {
        $entries = DiskMonitorEntry::latest()->get();
        return view('disk-monitor::entries', compact('entries'));
    }
}
