<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\WifiController;
use App\Http\Controllers\Api\CampaignController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', [AuthController::class,'login']);

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('users', [UserController::class,'list']);
    Route::get('logout', [AuthController::class,'logout']);
    Route::post('change-password', [AuthController::class,'changePassword']);
    // Route::get('profile', [AuthController::class,'profile']);
    Route::post('update-profile', [AuthController::class,'updateProfile']);
    Route::post('/user/create', [UserController::class,'store']);
    Route::get('/user/{id}', [UserController::class,'profile']);
    Route::get('/user/delete/{id}', [UserController::class,'delete']);
    Route::post('/user/change-role/{id}', [UserController::class,'changeRole']);
    Route::get('/roles', [RolesController::class,'list']);
    Route::post('/role/create', [RolesController::class,'store']);
    Route::get('/role/{id}', [RolesController::class,'show']);
    Route::get('/role/delete/{id}', [RolesController::class,'delete']);
    Route::post('/role/change-permission/{id}', [RolesController::class,'changePermissions']);
    Route::get('/permissions', [PermissionController::class,'list']);
    Route::post('/permission/create', [PermissionController::class,'store']);
    Route::get('/permission/{id}', [PermissionController::class,'show']);
    Route::get('/permission/delete/{id}', [PermissionController::class,'delete']);

    Route::get('/campaign-list', [CampaignController::class, 'campaignlist']);
    Route::post('/campaign', [CampaignController::class, 'store'])->name('campaign');
	Route::get('/campaign-stop', [CampaignController::class, 'stop'])->name('stop');
	Route::delete('/campaign-delete/{id}', [CampaignController::class, 'destroy'])->name('delete');
	Route::get('/campaign/select/{id}', [CampaignController::class, 'campaignselect'])->name('campaign-select');// for blade
	Route::get('/campaign/data/{id}', [CampaignController::class, 'campaigndata'])->name('campaign-data');//for ajax
	Route::get('/campaign/name/{id}', [CampaignController::class,'campaignname'])->name('campaign-name');


    Route::get('/wifi/inspect/{id}',[WifiController::class,'inspect']);
    Route::get('/wifi/attack/{id}', [WifiController::class,'attack']);
    Route::get('/wifi/stop/{id}', [WifiController::class,'stop']);
});

Route::get('/send', function () {
    broadcast(new App\Events\DeviceEvent());
    return response('Sent');
});

Route::get('/receiver', function () {
    return view('socket');
});
	
