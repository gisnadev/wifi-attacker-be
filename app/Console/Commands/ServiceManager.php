<?php
namespace App\Console\Commands;

use Illuminate\Support\Facades\Log;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class ServiceManager extends Command
{
    protected $signature = 'service:manage {name} {action=status}';
    protected $description = 'Manage a service';

    public function handle()
    {
        $service = $this->argument('name');
        $action = $this->argument('action');
        switch ($action) {
            case 'status':
                $process = new Process(["systemctl","is-active", $service]);
                  break;
            case 'start':
                $process = new Process(["systemctl" ,"start", $service]);
                break;
            case 'restart':
                $process =new Process(["systemctl","restart",$service]);
                break;
            case 'stop':
                $process =new Process(["systemctl","stop",$service]);
                break;
            default:
                $this->error("Invalid action");
                return;
        }

        $process->run();
        
        if ($process->isSuccessful()) {
            //$this->info(nl2br($process->getOutput()));
            Log::debug("Sakses");
        } else {
            //$this->error($process->getErrorOutput());
            $output = $process->getOutput();
            $errorOutput = $process->getErrorOutput();
            $exitCode = $process->getExitCode();

            Log::debug("failed with data :",[$exitCode,$output,$errorOutput]);

        }
        $this->info(nl2br($process->getOutput()));
        Log::debug("Service Manager Status",[$process->getOutput()]);
    }
}
