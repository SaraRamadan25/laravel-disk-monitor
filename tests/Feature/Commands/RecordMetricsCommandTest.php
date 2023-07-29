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
        Storage::fake('anotherDisk');

    }

    /** @test */

    public function it_will_record_the_file_count_for_a_single_disk()
    {

      $this->artisan(RecordDiskMetricsCommand::class)->assertExitCode(0);
      $entry = DiskMonitorEntry::last();
      $this->assertEquals(0, $entry->file_count);

      Storage::disk('local')->put('test.txt', 'test');
      $this->artisan(RecordDiskMetricsCommand::class)->assertExitCode(0);
        $entry = DiskMonitorEntry::last();
        $this->assertEquals(1, $entry->file_count);
    }

    /** @test */

    public function it_will_record_the_file_count_for_multiple_disks()
    {
        config()->set('disk-monitor.disk_names', ['local', 'anotherDisk']);
        Storage::disk('anotherDisk')->put('test.txt', 'test');

        $this->artisan(RecordDiskMetricsCommand::class)->assertExitCode(0);

        $entries = DiskMonitorEntry::get();
        $this->assertCount(2, $entries);

        $this->assertEquals('local',$entries[0]->disk_name);
        $this->assertEquals(0,$entries[0]->file_count);

        $this->assertEquals('anotherDisk',$entries[1]->disk_name);
        $this->assertEquals(1,$entries[1]->file_count);

    }
}
