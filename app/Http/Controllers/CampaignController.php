<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Client;
use App\Models\Devices;
use App\Models\Deauths;
use App\Models\DeauthJobs;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Carbon\Carbon;
class CampaignController extends Controller
{
    public function store(Request $request)
    {
        Campaign::create([
            'name' => $request->input('name'),
            'status' => 'active'
        ]);

        // $service = '/home/attacker/wifighter/services/startservice.py';
        $service = '/home/me/wifi-attacker-services/startservice.py';

        $servicerun = new Process(['sudo', 'python3', $service]);
        // $command = ['echo', '1', '|', 'sudo', '-S', 'python3', $service];
        
        // $servicerun = new Process($servicerun);

        $servicerun->run();

        if (!$servicerun->isSuccessful()) {
            throw new ProcessFailedException($servicerun);
        }
        return redirect('/');
    }

    public function stop()
    {
        $lastCampaign = Campaign::orderBy('created_at', 'desc')->first();

        if ($lastCampaign) {
            $lastCampaign->update([
                'status' => 'inactive',
            ]);
        }

        $service = '/home/me/wifi-attacker-services/stopservice.py';

        $command = ['echo', '1', '|', 'sudo', '-S', 'python3', $service];
        
        $servicerun = new Process($command);
        $servicerun->run();

        if (!$servicerun->isSuccessful()) {
            throw new ProcessFailedException($servicerun);
        }

        return redirect('/');
    }

    public function destroy($id)
    {

        Devices::where('id_campaign', $id)->delete();
        Client::where('id_campaign', $id)->delete();

        // Hapus campaign
        Campaign::destroy($id);
        return redirect('/');
    }

    public function campaignselect($id){
        $devices = Devices::where('id_campaign', $id)->paginate(10);
        $clients = Client::where('id_campaign', $id)->get();
        $campaign =  Campaign::all();
        $lastCampaign = Campaign::orderBy('created_at', 'desc')->first();        


        return view('pages/dashboard-select',compact('devices', 'clients','campaign','lastCampaign' ));
    }

    public function campaigndata($id){

        $length = request('length', 10);
        $devices = Devices::where('id_campaign', $id)->orderBy('updated_at', 'desc')->get();
        // $deauths = Deauths::orderBy('updated_at', 'desc')->get();
        $deauth_jobs = DeauthJobs::where('id_campaign', $id)->orderBy('updated_at', 'desc')->get(); 
        $clients = Client::where('id_campaign', $id)->orderBy('updated_at', 'desc')->get(); 
        $data   = array(
            'devices'=>$devices,
            'deauths'=>$deauth_jobs,
            'clients'=>$clients,
            'carbon'=>Carbon::now()->subMinutes(5)->toDateTimeString()
        );
        return response()->json(array('status'=>'OK','data'=> $data), 200);
    }

    public function campaignname($id){
        $campaign = Campaign::where('id', $id)->get();

        return response()->json(array('status'=>'OK','campaign' => $campaign), 200);
    }
}
