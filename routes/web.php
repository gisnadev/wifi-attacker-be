<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\WifiController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CampaignController;
use App\Events\DeviceEvent;

use App\Event\WifiFlag;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 
Route::get('mail', [HomeController::class,'mail'])->name('home.mail');

Route::get('test', function(){
    broadcast(new \App\Events\WifiFlag);
});

Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::post('register', [RegisterController::class,'register']);

Route::get('password/forget',  function () { 
	return view('pages.forgot-password'); 
})->name('password.forget');
Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');


Route::group(['middleware' => 'auth'], function(){
	// logout route
	Route::get('/logout', [LoginController::class,'logout']);
	Route::get('/clear-cache', [HomeController::class,'clearCache']);

	// dashboard route  
	Route::get('/', [WifiController::class , 'wifi_table'])->name('dashboard');

	Route::get('/dashboard', [WifiController::class , 'wifi_table'])->name('dashboard');
	Route::get('/wifi/search', [WifiController::class , 'search'])->name('wifi-search');
	Route::get('/wifi/inspect/{id}',[WifiController::class,'view'])->name('wifi-inspect');
	// data retriever
	Route::get('/wifi/recent',[WifiController::class,'recent'])->name('wifi-recent');
	Route::post('/wifi/post/attack/{id}', [WifiController::class,'attack'])->name('wifi-attack');
	Route::post('/wifi/post/pause', [WifiController::class,'pause'])->name('wifi-attack-pause');
	//only those have manage_user permission will get access
	Route::group(['middleware' => 'can:manage_user'], function(){
	Route::get('/users', [UserController::class,'index'])->name('users');
	Route::get('/user/search', [UserController::class , 'search'])->name('user-search');
	Route::get('/user/get-list', [UserController::class,'getUserList']);
		Route::get('/user/create', [UserController::class,'create']);
		Route::post('/user/create', [UserController::class,'store'])->name('create-user');
		Route::get('/user/detail/{id}', [UserController::class,'detail']);
		Route::get('/user/{id}', [UserController::class,'edit']);
		Route::post('/user/update', [UserController::class,'update']);
		Route::get('/user/delete/{id}', [UserController::class,'delete']);
	});

	Route::post('/campaign', [CampaignController::class, 'store'])->name('campaign');
	Route::get('/campaign-stop', [CampaignController::class, 'stop'])->name('stop');
	Route::delete('/campaign-delete/{id}', [CampaignController::class, 'destroy'])->name('delete');
	Route::get('/campaign/select/{id}', [CampaignController::class, 'campaignselect'])->name('campaign-select');// for blade
	Route::get('/campaign/data/{id}',[CampaignController::class, 'campaigndata'])->name('campaign-data');//for ajax
	Route::get('/campaign/name/{id}', [CampaignController::class,'campaignname'])->name('campaign-name');

	//only those have manage_role permission will get access
	Route::group(['middleware' => 'can:manage_role|manage_user'], function(){
		Route::get('/roles', [RolesController::class,'index']);
		Route::get('/role/get-list', [RolesController::class,'getRoleList']);
		Route::post('/role/create', [RolesController::class,'create']);
		Route::get('/role/edit/{id}', [RolesController::class,'edit']);
		Route::post('/role/update', [RolesController::class,'update']);
		Route::get('/role/delete/{id}', [RolesController::class,'delete']);
	});


	//only those have manage_permission permission will get access
	Route::group(['middleware' => 'can:manage_permission|manage_user'], function(){
		Route::get('/permission', [PermissionController::class,'index']);
		Route::get('/permission/get-list', [PermissionController::class,'getPermissionList']);
		Route::post('/permission/create', [PermissionController::class,'create']);
		Route::get('/permission/update', [PermissionController::class,'update']);
		Route::get('/permission/delete/{id}', [PermissionController::class,'delete']);
	});

	// get permissions
	Route::get('get-role-permissions-badge', [PermissionController::class,'getPermissionBadgeByRole']);


	// permission examples
    Route::get('/permission-example', function () {
    	return view('permission-example'); 
    });
    // API Documentation
    Route::get('/rest-api', function () { return view('api'); });
    // Editable Datatable
	Route::get('/table-datatable-edit', function () { 
		return view('pages.datatable-editable'); 
	});

    // Themekit demo pages
	Route::get('/calendar', function () { return view('pages.calendar'); });
	Route::get('/charts-amcharts', function () { return view('pages.charts-amcharts'); });
	Route::get('/charts-chartist', function () { return view('pages.charts-chartist'); });
	Route::get('/charts-flot', function () { return view('pages.charts-flot'); });
	Route::get('/charts-knob', function () { return view('pages.charts-knob'); });
	Route::get('/forgot-password', function () { return view('pages.forgot-password'); });
	Route::get('/form-addon', function () { return view('pages.form-addon'); });
	Route::get('/form-advance', function () { return view('pages.form-advance'); });
	Route::get('/form-components', function () { return view('pages.form-components'); });
	Route::get('/form-picker', function () { return view('pages.form-picker'); });
	Route::get('/invoice', function () { return view('pages.invoice'); });
	Route::get('/layout-edit-item', function () { return view('pages.layout-edit-item'); });
	Route::get('/layouts', function () { return view('pages.layouts'); });

	Route::get('/navbar', function () { return view('pages.navbar'); });
	Route::get('/profile', function () { return view('pages.profile'); });
	Route::get('/project', function () { return view('pages.project'); });
	Route::get('/view', function () { return view('pages.view'); });

	Route::get('/table-bootstrap', function () { return view('pages.table-bootstrap'); });
	Route::get('/table-datatable', function () { return view('pages.table-datatable'); });
	Route::get('/taskboard', function () { return view('pages.taskboard'); });
	Route::get('/widget-chart', function () { return view('pages.widget-chart'); });
	Route::get('/widget-data', function () { return view('pages.widget-data'); });
	Route::get('/widget-statistic', function () { return view('pages.widget-statistic'); });
	Route::get('/widgets', function () { return view('pages.widgets'); });

	// themekit ui pages
	Route::get('/alerts', function () { return view('pages.ui.alerts'); });
	Route::get('/badges', function () { return view('pages.ui.badges'); });
	Route::get('/buttons', function () { return view('pages.ui.buttons'); });
	Route::get('/cards', function () { return view('pages.ui.cards'); });
	Route::get('/carousel', function () { return view('pages.ui.carousel'); });
	Route::get('/icons', function () { return view('pages.ui.icons'); });
	Route::get('/modals', function () { return view('pages.ui.modals'); });
	Route::get('/navigation', function () { return view('pages.ui.navigation'); });
	Route::get('/notifications', function () { return view('pages.ui.notifications'); });
	Route::get('/range-slider', function () { return view('pages.ui.range-slider'); });
	Route::get('/rating', function () { return view('pages.ui.rating'); });
	Route::get('/session-timeout', function () { return view('pages.ui.session-timeout'); });
	Route::get('/pricing', function () { return view('pages.pricing'); });


	// new inventory routes
	Route::get('/inventory', function () { return view('inventory.dashboard'); });
	Route::get('/pos', function () { return view('inventory.pos'); });
	Route::get('/products', function () { return view('inventory.product.list'); });
	Route::get('/products/create', function () { return view('inventory.product.create'); }); 
	Route::get('/categories', function () { return view('inventory.category.index'); }); 
	Route::get('/sales', function () { return view('inventory.sale.list'); });
	Route::get('/sales/create', function () { return view('inventory.sale.create'); }); 
	Route::get('/purchases', function () { return view('inventory.purchase.list'); });
	Route::get('/purchases/create', function () { return view('inventory.purchase.create'); }); 
	Route::get('/customers', function () { return view('inventory.people.customers'); }); 
	Route::get('/suppliers', function () { return view('inventory.people.suppliers'); }); 

	//Data Tables
	

	//Analyze
	Route::get('/normal-ap', [WifiController::class,'normal_ap'])->name('normal-ap');
	Route::get('/normal-ap/search', [WifiController::class,'normal_ap_search'])->name('normal-ap-search');

	Route::get('/rouge-ap', [WifiController::class,'rouge_ap'])->name('rouge-ap');
	Route::get('/rouge-ap/search', [WifiController::class,'rouge_ap_search'])->name('rouge-ap-search');

	Route::get('/deauth', [WifiController::class,'deauth'])->name('deauth');
	Route::get('/deauth/search', [WifiController::class,'deauth_search'])->name('deauth_search');

	Route::get('/deauth/detail/{id}', [WifiController::class, 'deauth_detail'])->name('deauth-detail');
	Route::get('/cracking', [WifiController::class,'cracking'])->name('cracking');
	Route::get('/arp-attact', [WifiController::class,'arp_attact'])->name('arp-attact');
	Route::get('/clients', [WifiController::class,'clients'])->name('clients');


	//Services
	Route::get('/services',[WifiController::class, 'services'])->name('scanner');


	//Setting
	Route::get('/settings/devices',[SettingController::class, 'index']);
	Route::get('/settings/services',[SettingController::class, 'services']);
	Route::post('/settings/mail',[SettingController::class,'storeMail']);
	Route::post('/settings/telegram',[SettingController::class,'storeTelegram']);
	Route::post('/settings/slack',[SettingController::class,'storeSlack']);
	Route::post('/settings/network',[SettingController::class,'storeNetwork']);
	Route::post('/settings/deletedb',[SettingController::class,'deletedb']);
	Route::post('/settings/services/restart',[SettingController::class, 'restartServices']);

	/*Route::get('/devices', [SettingController::class, 'devices']);
	Route::get('/notification', [SettingController::class, 'notification']);
	Route::get('/databases', [SettingController::class, 'databases']);*/
	
});


Route::get('/register', function () { return view('pages.register'); });
Route::get('/login-1', function () { return view('pages.login'); });

Route::get('/send', function () {
    broadcast(new App\Events\DeviceEvent());
    return response('Sent');
});

Route::get('/receiver', function () {
    return view('socket');
});
