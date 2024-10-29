<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class SetDynamicIp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'network:set-dynamic-ip {interface}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set a dynamic IP for the specified network interface using DHCP';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $interface = $this->argument('interface');

        // Set the interface to use DHCP for IP address assignment
        $process = new Process(['nmcli', 'con', 'mod', $interface, 'ipv4.method', 'auto']);
        $process->run();

        $this->info("Dynamic IP set for $interface");
    }
}
