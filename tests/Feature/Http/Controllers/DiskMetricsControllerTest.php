<?php

namespace Spatie\LaravelDiskMonitor\Tests\Feature\Http\Controllers;
use Spatie\LaravelDiskMonitor\Tests\TestCase;

class DiskMetricsControllerTest extends TestCase
{

    /** @test */
    public function it_can_display_the_list_of_entries()
    {
        $this
            ->get('disk-monitor')
            ->assertOk();
    }

}
