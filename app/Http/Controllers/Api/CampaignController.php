<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Client;
use App\Models\Devices;
use App\Models\Deauths;
use App\Models\DeauthJobs;
use Symfony\Component\Process\Process;
use Symfony\Componen;
use Carbon\Carbon;

class CampaignController extends Controller
{
    public function store(Request $request)
    {
        $newCampaign = Campaign::create([
            'name' => $request->input('name'),
            'status' => 'active'
        ]);
        try {
            $service = '/home/me/wifi-attacker-services/startservice.py';

            $servicerun = new Process(['sudo', 'python3', $service]);

            $servicerun->run();

            if (!$servicerun->isSuccessful()) {
                throw new ProcessFailedException($servicerun);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to start service: ' . $e->getMessage(),
            ]);
        }
        

        if ($newCampaign){
            return response()->json([
                'status'=>'OK',
                'message'=>'campaign created',
                'data'=>$newCampaign
            ],200);
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'campaign not created',
            ],500);
        }
    }

    public function stop()
    {
        $lastCampaign = Campaign::orderBy('created_at', 'desc')->first();

        $updateCampaign = $lastCampaign->update([
            'status' => 'inactive',
        ]);
        try {
            $service = '/home/me/wifi-attacker-services/stopservice.py';

            $servicerun = new Process(['sudo', 'python3', $service]);
            $servicerun->run();

            if (!$servicerun->isSuccessful()) {
                throw new ProcessFailedException($servicerun);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to stop service: ' . $e->getMessage(),
            ]);
        }


        if ($updateCampaign){
            return response()->json([
                'status'=>'OK',
                'message'=>'campaign stop success',
            ],200);
        }else{
            return response()->json([
                'status'=>'Error',
                'message'=>'campaign not update',
            ],500);
        }
    }

    public function destroy($id)
    {

        Devices::where('id_campaign', $id)->delete();
        Client::where('id_campaign', $id)->delete();

        // Hapus campaign
        $campaignDelete = Campaign::destroy($id);
        // return redirect('/');
        if ($campaignDelete){
            return response()->json([
                'status'=>'OK',
                'message'=>'campaign delete success',
            ],200);
        }else{
            return response()->json([
                'status'=>'Error',
                'message'=>'campaign not deteled',
            ],500);
        }
    }

    public function campaignselect($id){
        $devices = Devices::where('id_campaign', $id)->paginate(10);
        $clients = Client::where('id_campaign', $id)->get();
        $campaign =  Campaign::all();
        $selectCampaign = Campaign::find($id);       

        if ($selectCampaign) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => [
                    'devices' => $devices,
                    'clients' => $clients,
                    'campaigns' => $campaign,
                    // 'last_campaign' => $lastCampaign,
                ],
            ],200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No campaigns found',
            ],404);
        }
    }

    public function campaigndata($id){

        $length = request('length', 10);
        $devices = Devices::where('id_campaign', $id)->orderBy('updated_at', 'desc')->get();
        // $deauths = Deauths::orderBy('updated_at', 'desc')->get();
        $deauth_jobs = DeauthJobs::where('id_campaign', $id)->orderBy('updated_at', 'desc')->get(); 
        $clients = Client::where('id_campaign', $id)->orderBy('updated_at', 'desc')->get();
        $campaign = Campaign::find($id);  
        $data   = array(
            'campaign'=>$campaign,
            'devices'=>$devices,
            'deauths'=>$deauth_jobs,
            'clients'=>$clients,
            'carbon'=> Carbon::now()->subMinutes(5)->toDateTimeString(),
        );
        return response()->json(array('status'=>'OK','data'=> $data), 200);
    }

    public function campaignname($id){
        $campaign = Campaign::where('id', $id)->get();

        return response()->json(array('status'=>'OK','campaign' => $campaign), 200);
    }

    public function campaignlist(){
        $campaign = Campaign::get();
        return response()->json(array('status'=>'OK','campaign' => $campaign), 200);
    }
}
