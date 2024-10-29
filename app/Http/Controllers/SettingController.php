<?php

namespace App\Http\Controllers;

use App\Models\Deauths;
use App\Models\Devices;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use Sabre\Xml\Service;
use Larinfo;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\File;




class SettingController extends Controller
{
    public function index()
    {
        $env = Yaml::parse(File::get($this->getYamlPath()));
        $smtpAddress = $env['MAIL_HOST'];
        $smtpPort = $env['MAIL_PORT'];
        $smtpUsername = $env['MAIL_USERNAME'];
        $smtpPassword = $env['MAIL_PASSWORD'];
        $telegramToken = $env['TELEGRAM_BOT_TOKEN'];
        $slackWebhook = $env['SLACK_WEBHOOK'];
        $network = $env['NETWORK_TYPE'];
        $telegramChecked = "";
        $slackChecked = "";
        Log::debug("env", [$smtpAddress]);
        if ($env['TELEGRAM_BOT'] == 1) {
            $telegramChecked = "checked";
        }
        if ($env['SLACK'] == 1) {
            $slackChecked = "checked";
        }
        return view(
            'pages.settings.devices',
            [
                'smtpAddress' => $smtpAddress,
                'smtpPort' => $smtpPort,
                'smtpUsername' => $smtpUsername,
                'smtpPassword' => $smtpPassword,
                'telegramToken' => $telegramToken,
                'telegramChecked' => $telegramChecked,
                'slackWebhook' => $slackWebhook,
                'slackChecked' => $slackChecked,
                'network' => $network
            ]
        );
    }

    public function storeMail(Request $request)
    {
        $user = User::first();
        $request->validate([
            'smtpaddress' => 'required',
            'smtpport' => 'numeric',
            'smtpusername' => 'required',
        ]);
        $this->setEnvironmentValue("MAIL_HOST", $request->smtpaddress);
        $this->setEnvironmentValue("MAIL_PORT", $request->smtpport);
        $this->setEnvironmentValue("MAIL_USERNAME", $request->smtpusername);
        if ($request->smtppassword != "") {
            $this->setEnvironmentValue("MAIL_PASSWORD", $request->smtppassword);
        }

        return response()->json(['status' => 'OK']);
    }
    public function storeTelegram(Request $request)
    {
        $enabled = false;
        if ($request->featureEnabler == 'true') {
            $enabled = true;
            $request->validate([
                'token' => 'required'
            ]);
        }
        $this->setEnvironmentValue("TELEGRAM_BOT_TOKEN", $request->token);
        $this->setEnvironmentValue("TELEGRAM_BOT", $enabled);
        return response()->json(['status' => "OK"]);
    }
    public function storeSlack(Request $request)
    {
        $enabled = false;
        if ($request->featureEnabler == 'true') {
            $enabled = true;
            $request->validate([
                'slackWebhook' => 'required'
            ]);
        }
        $this->setEnvironmentValue("SLACK_WEBHOOK", $request->slackWebhook);
        $this->setEnvironmentValue("SLACK", $enabled);
        return response()->json(['status' => "OK"]);
    }

    public function storeNetwork(Request $request)
    {
        $request->validate([
            'networkMode' => 'required'
        ]);
        $this->setEnvironmentValue("NETWORK_TYPE", $request->networkMode);
        $this->setEnvironmentValue("NETWORK_ISEDIT", true);
        $command = ['python3', '/home/attacker/wifighter/services/netmode.py'];

        $process = new Process(['netplan', 'apply']);
        $process->setEnv([
            'TERM' => 'xterm',
            'HOME' => '/home/attacker/wifighter',
            'USER' => 'attacker',
        ]);
        $process->run();

        if (!$process->isSuccessful()) {
            // Handle error
        }

        // Output the command output
        //echo $process->getOutput();
        return response()->json(['status' => "OK", 'data' => $process->getErrorOutput(), 'succes' => $process->getExitCode()]);
    }
    public function deletedb(Request $request)
    {
        Devices::query()->delete();
        Client::query()->delete();
        Deauths::query()->delete();
        return response()->json(['status' => "OK"]);
    }

    private function setEnvironmentValue($envKey, $envValue)
    {
        /*
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        $str .= "\n"; 
        $keyPosition = strpos($str, "{$envKey}=");
        $endOfLinePosition = strpos($str, PHP_EOL, $keyPosition);
        $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
        $str = substr($str, 0, -1);
        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
        */
        $yamlData = Yaml::parse(File::get($this->getYamlPath()));

        // Update the value of the key
        $yamlData[$envKey] = $envValue;
        $yamlData['ISEDITED']=true;

        // Write the updated YAML back to the file
        File::put($this->getYamlPath(), Yaml::dump($yamlData));
    }

    public function services()
    {
        $logs = $this->LogHandler('/var/log/scanner.log');
        $larinfo = Larinfo::getInfo();
        $scannerStatus = $this->SupervisorHandler('scanner', 'status');
        $ingesterStatus = $this->SupervisorHandler('ingester', 'status');

        $serviceStatus = 'not running';
        if ($scannerStatus['result'] == true && $ingesterStatus['result'] == true) {
            $serviceStatus = 'running';
        }
        return view('pages.settings.services', [
            'serviceStatus' => $serviceStatus,
            'hwinfo' => $larinfo['server']['hardware'],
            'uptime' => $larinfo['server']['uptime']['uptime'],
            'logs' => $logs
        ]);
    }

    public function restartServices(Request $request)
    {
        $result = ["result" => "FAIL", "data" => ''];
        $stopScanner = $this->SupervisorHandler('scanner', 'stop');
        sleep(2);
        $startScanner = $this->SupervisorHandler('scanner', 'start');

        $stopIngester = $this->SupervisorHandler('ingester', 'stop');
        sleep(2);
        $startIngester = $this->SupervisorHandler('ingester', 'start');

        $scannerStatus = $this->ctlStatus('scanner');
        $ingesterStatus = $this->ctlStatus('ingester');

        $serviceStatus = 'not running';
        if ($scannerStatus['result'] == true && $ingesterStatus['result'] == true) {
            $serviceStatus = 'running';
            $result = ["result" => "OK", "data" => $scannerStatus];
        }

        return $result;
    }


    private function LogHandler($logs)
    {
        $content = file_get_contents($logs);
        return $content;
    }
    private function SupervisorHandler($service, $event)
    {
        $client = new GuzzleClient();

        $endpointUrl = 'http://127.0.0.1:9001/RPC2';
        switch ($event) {
            case 'status':
                $request = xmlrpc_encode_request('supervisor.getProcessInfo', [$service]);
                break;
            case 'stop':
                $request = xmlrpc_encode_request('supervisor.stopProcess', [$service, true]);
                break;
            case 'start':
                $request = xmlrpc_encode_request('supervisor.startProcess', [$service, true]);
                break;
        }


        try {
            $response = $client->post($endpointUrl, [
                'headers' => [
                    'Content-Type' => 'text/xml',
                ],
                'body' => $request,
            ]);

            $service = new Service();
            $res = false;
            $status = "unknown";
            if (strpos($response->getBody(), "RUNNING") !== false) {
                $res = true;
                $status = "running";
            } else if (strpos($response->getBody(), "STOPPED") !== false) {
                $status = "stopped";
            } else if (strpos($response->getBody(), "BAD_NAME") !== false) {
                $status = "notfound";
            }
        } catch (RequestException $e) {
            $status = $e->getMessage();
        } catch (\Exception $e) {
            $status = $e->getMessage();
        }

        return ["result" => $res, 'status' => $status];
    }

    private function getYamlPath()
    {
        return '/var/www/html/wifighter/config.yaml';
    }


}