<?php

namespace Spatie\LaravelDiskMonitor\Tests\Feature\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelDiskMonitor\Models\DiskMonitorEntry;
use Spatie\LaravelDiskMonitor\Commands\RecordDiskMetricsCommand;
use Spatie\LaravelDiskMonitor\Tests\TestCase;

class RecordMetricsCommandTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');

    }

    /** @test */

    public function it_will_record_the_file_count_for_a_disk()
    {

      $this->artisan(RecordDiskMetricsCommand::class)->assertExitCode(0);
      $entry = DiskMonitorEntry::last();
      $this->assertEquals(0, $entry->file_count);

      Storage::put('test.txt', 'test');
      $this->artisan(RecordDiskMetricsCommand::class)->assertExitCode(0);
        $entry = DiskMonitorEntry::last();
        $this->assertEquals(1, $entry->file_count);
    }
}
