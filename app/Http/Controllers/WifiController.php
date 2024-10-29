<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Client;
use App\Models\Devices;
use App\Models\Deauths;
use App\Models\DeauthJobs;
use App\Models\Campaign;
use Auth;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
// use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class WifiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view($id)
    {
        try {
            $data = Devices::find($id);
            $deauthJobs = DeauthJobs::where('target', $data->bssid)->first();
            return view("wifi/view")->with(array('data' => $data, 'deauthJobs' => $deauthJobs));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function view2()
    {
        try {
            return response()->json([
                'data' => "hahaha",
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function attack(Request $request)
    {
        $post = DeauthJobs::where('target', $request['target'])
                        ->where('id_campaign', $request['id_campaign'])
                        ->first();
        if ($post) {
            $post->status = "started";
        } else {
            $post = new DeauthJobs();
            $post->target = $request['target'];
            $post->channel = $request['channel'];
            $post->pid = $request['pid'];
            $post->status = "started";
            $post->id_campaign =  $request['id_campaign'];
        }
        $post->save();
        // for running script python in background
        // $service = '/home/attacker/wifighter/services/attack.py';
        // $servicerun = new Process(['sudo', 'python3', $service, $request['target'],$request['channel'], '&']);
        // $servicerun->run();
        
        // if (!$servicerun->isSuccessful()) {
        //     throw new ProcessFailedException($servicerun);
        // }
            
        $service = '/home/me/wifi-attacker-services/attack.py';
        $target = escapeshellarg($request['target']);
        $channel = escapeshellarg($request['channel']);
        $command = 'sudo python3 ' . $service . ' ' . $target . ' ' . $channel;
        // $command = 'sudo python3 ' . $service . ' ' . escapeshellarg($request['target'],$request['channel']);
        exec($command . ' > /dev/null 2>&1 &');

        return response()->json(array('status' => 'OK'), 200); 
            
    }
    public function pause(Request $request)
    {
        $post = DeauthJobs::where('target', $request['target'])->first();
        $post->target = $request['target'];
        $post->channel = $request['channel'];
        $post->pid = $request['pid'];
        $post->status = "notstarted";
        $post->save();

        // $service = '/home/attacker/wifighter/services/stop.py';
        // $servicerun = new Process(['sudo', 'python3', $service, '&' ]);
        // $servicerun->run();

        // if (!$servicerun->isSuccessful()) {
        //     throw new ProcessFailedException($servicerun);
        // }

        $service = '/home/me/wifi-attacker-services/stop.py';
        $command = 'sudo python3 ' . $service;
        exec($command . ' > /dev/null 2>&1 &');

        return response()->json(array('status' => 'OK'), 200);
    }
    public function recent()
    {
        /*$devices = Devices::where('updated_at', '>', Carbon::now()->subMinutes(5)->toDateTimeString())->orderBy('updated_at', 'desc')->get(); 
        $deauths = Deauths::where('updated_at', '>', Carbon::now()->subMinutes(5)->toDateTimeString())->orderBy('updated_at', 'desc')->get(); 
        */
        $devices = Devices::orderBy('updated_at', 'desc')->get();
        $deauths = Deauths::orderBy('updated_at', 'desc')->get();
        $clients = Client::orderBy('updated_at', 'desc')->get();
        $data   = array(
            'devices' => $devices,
            'deauths' => $deauths,
            'clients' => $clients,
            'carbon' => Carbon::now()->subMinutes(5)->toDateTimeString()
        );
        return response()->json(array('status' => 'OK', 'data' => $data), 200);
    }

    //yajra table wifi
    public function wifi_table()
    {
        if (request()->ajax()) {
            $data = Devices::get();
            return DataTables::of($data)

                ->make(true);
        }
        $wifi = DB::table('devices')->paginate(10);
        $campaign =  Campaign::all();
        $lastCampaign = Campaign::orderBy('created_at', 'desc')->first();
        // dd($campaign);
        return view('pages/dashboard', compact('wifi', 'campaign', 'lastCampaign'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $wifi = DB::table('devices')
            ->where('ssid', 'like', "%" . $search . "%")
            ->paginate();
        return view('pages/dashboard', ['wifi' => $wifi]);
    }

    public function normal_ap()
    {
        if (request()->ajax()) {
            $data = Devices::get()->where('attackmode', '=', "normal");
            return DataTables::of($data)

                ->make(true);
        }
        $normal_ap = DB::table('devices')->where('attackmode', '=', "normal")->paginate(10);
        return view('pages/normal-ap', ['normal_ap' => $normal_ap]);
    }

    public function normal_ap_search(Request $request)
    {
        $search = $request->search;
        $normal_ap = DB::table('devices')
            ->where('ssid', 'like', "%" . $search . "%")
            ->paginate();
        return view('pages/normal-ap', ['normal_ap' => $normal_ap]);
    }


    public function rouge_ap()
    {
        if (request()->ajax()) {
            $data = Devices::get()->where('attackmode', '=', "suspect");
            return DataTables::of($data)

                ->make(true);
        }
        $rouge_ap = DB::table('devices')->where('attackmode', '=', "suspect")->paginate(10);
        return view('pages/rouge-ap', ['rouge_ap' => $rouge_ap]);
    }

    public function rouge_ap_search(Request $request)
    {
        $search = $request->search;
        $rouge_ap = DB::table('devices')
            ->where('ssid', 'like', "%" . $search . "%")
            ->paginate();
        return view('pages/rouge-ap', ['rouge_ap' => $rouge_ap]);
    }

    public function deauth()
    {
        if (request()->ajax()) {
            $data = Deauths::get();
            return DataTables::of($data)

                ->make(true);
        }
        $deauth = DB::table('deauths')->paginate(10);
        return view('pages/deauth', ['deauth' => $deauth]);
    }

    public function deauth_search(Request $request)
    {
        $search = $request->search;
        $deauth = DB::table('deauths')
            ->where('addr1', 'like', "%" . $search . "%")
            ->paginate();
        return view('pages/deauth', ['deauth' => $deauth]);
    }

    public function deauth_detail($id)
    {
        $data = Deauths::find($id);
        $deauthJobs = DeauthJobs::where('target', $data->bssid)->first();
        return view('pages.deauth-detail')->with(array('data' => $data, 'deauthJobs' => $deauthJobs));
    }

    public function cracking()
    {
        if (request()->ajax()) {
            $data = Devices::get()->where('attackmode', '=', "cracking");;
            return DataTables::of($data)

                ->make(true);
        }
        return view('pages.cracking');
    }

    public function arp_attact()
    {
        return view('pages.arp-attact');
    }

    public function clients()
    {
        return view('pages.clients');
    }

    //services
    public function services()
    {
        return view("pages.services");
    }
}
