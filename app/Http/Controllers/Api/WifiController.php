<?php

namespace App\Http\Controllers\Api;
use App\Models\Devices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeauthJobs;
use App\Models\Campaign;

class WifiController extends Controller
{
    public function inspect($id)
    {
        try {
            $data = Devices::find($id);
            $campaign = Campaign::where('id',$data->id_campaign)->first();
            $deauthJobs = DeauthJobs::where('target', $data->bssid)->first();
            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => [
                    'campaign' => $campaign,
                    'wifi' => $data,
                    'deauthJobs' => $deauthJobs
                ],
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function attack($id)
    {
        $data = Devices::find($id);   

        $target = DeauthJobs::where('target', $data->bssid)
                        ->where('id_campaign', $data->id_campaign)
                        ->first();
        
        if ($target) {
            $target->status = "started";
        } else {
            $target = new DeauthJobs();
            $target->target = $data->bssid;
            $target->channel = $data->channel;
            $target->pid = 10;
            $target->status = "started";
            $target->id_campaign =  $data->id_campaign;
        }
        $target->save();
            
        $service = '/home/me/wifi-attacker-services/attack.py';
        $target = escapeshellarg($data->bssid);
        $channel = escapeshellarg($data->id_campaign);
        $command = 'sudo python3 ' . $service . ' ' . $target . ' ' . $channel;
        // $command = 'sudo python3 ' . $service . ' ' . escapeshellarg($request['target'],$request['channel']);
        exec($command . ' > /dev/null 2>&1 &');

        return response()->json(array('status' => 'OK'), 200); 
            
    }


    public function stop($id)
    {
        $data = Devices::find($id); 
        $target = DeauthJobs::where('target', $data->bssid)->first();
        $target->target = $data->bssid;
        $target->channel = $data->channel;
        $target->pid = 10;
        $target->status = "notstarted";
        $target->save();

        $service = '/home/me/wifi-attacker-services/stop.py';
        $command = 'sudo python3 ' . $service;
        exec($command . ' > /dev/null 2>&1 &');

        return response()->json(array('status' => 'OK'), 200);
    }
}
