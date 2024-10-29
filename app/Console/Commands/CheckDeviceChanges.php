<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\DeviceEvent;
use App\Models\Devices;

class CheckDeviceChanges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:device-changes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for changes in the devices table and broadcast an event if changes are detected';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // broadcast(new DeviceEvent());
        // $this->info('Device event broadcasted.');
        $interval = 5; // Interval waktu dalam detik
        $maxIterations = 60 / $interval; // Maksimal iterasi dalam satu menit

        for ($i = 1; $i <= $maxIterations; $i++) {
            // Lakukan pemancaran event
            broadcast(new DeviceEvent());
            $this->info('Device event broadcasted.');

            // Tidur selama interval waktu sebelum melanjutkan iterasi berikutnya
            sleep($interval);
        }
    }
}
