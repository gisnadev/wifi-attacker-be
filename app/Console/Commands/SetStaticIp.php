<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class SetStaticIp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'network:set-static-ip {interface} {ipAddress} {netmask} {gateway}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set a static IP for the specified network interface';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $interface = $this->argument('interface');
        $ipAddress = $this->argument('ipAddress');
        $netmask = $this->argument('netmask');
        $gateway = $this->argument('gateway');

        // Set the IP address, netmask, and gateway for the specified interface
        $process = new Process(['nmcli', 'con', 'mod', $interface,
                                'ipv4.addresses', "$ipAddress/$netmask",
                                'ipv4.gateway', $gateway, 'ipv4.method', 'manual']);
        $process->run();

        $this->info("Static IP set for $interface");
    }
}
