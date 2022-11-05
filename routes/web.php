<?php

use App\Http\Controllers\GatewayController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\BillPlanController;
use App\Http\Controllers\DidNumberController;
use App\Http\Controllers\DidNumberImportController;
use App\Http\Controllers\SofiaRateplanController;
use App\Http\Controllers\SofiaRateController;
use App\Http\Controllers\OriginationBillPlanController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorSettingController;

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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();


/* use only after successfully Authentication - login*/
Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //------------------------user start-------------------------------------
    Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('checkPermission:user_list');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('checkPermission:user_create|user_list');
    Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('checkPermission:user_list|user_create');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('checkPermission:user_list|user_update');
    Route::post('/users/{id}/update', [UserController::class, 'update'])->name('users.update')->middleware('checkPermission:user_list|user_update');
    Route::get('/users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy')->middleware('checkPermission:user_list|user_delete');

    //------------------------edit profile start--------------------------------
    Route::get('profile', [UserController::class, 'editProfile'])->name('users.editprofile');
    Route::post('/users/{id}/updateprofile', [UserController::class, 'updateProfile'])->name('users.updateprofile');

    //------------------------edit profile end----------------------------------
    
    //------------------------change password strat------------------------------
    Route::get('changepassword', [UserController::class, 'changePassword'])->name('users.changepassword');
    Route::post('updatepassword', [UserController::class, 'updatePassword'])->name('users.submitchangepassword');
    //------------------------change password end--------------------------------

    //-----------------------------signout start-----------------------------------
    Route::get('signout', [UserController::class,'signout'])->name('signout');
    //-----------------------------signout end-------------------------------------

    //------------------------user end-------------------------------------


    //------------------------role start-------------------------------------
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index')->middleware('checkPermission:role_list');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('checkPermission:role_create|role_list');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store')->middleware('checkPermission:role_create|role_list');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('checkPermission:role_update|role_list');
    Route::post('/roles/{id}/update', [RoleController::class, 'update'])->name('roles.update')->middleware('checkPermission:role_update|role_list');
    Route::get('/roles/{id}/destroy', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('checkPermission:role_delete|role_list');
    //------------------------role end-------------------------------------

    //------------------------leads start-------------------------------------
    Route::get('/leads', [LeadController::class, 'index'])->name('leads.index')->middleware('checkPermission:lead_list'); 
    Route::post('/leads/import', [LeadController::class, 'import'])->name('leads.import')->middleware('checkPermission:lead_list'); 
    Route::get('/leads/export', [LeadController::class, 'export'])->name('leads.export')->middleware('checkPermission:lead_list'); 
    //------------------------leads end-------------------------------------

    //------------------------gateways start-------------------------------------
    Route::get('/gateways', [GatewayController::class, 'index'])->name('gateways.index')->middleware('checkPermission:gateway_list');
    Route::get('/gateways/create', [GatewayController::class, 'create'])->name('gateways.create')->middleware('checkPermission:gateway_list|gateway_create');
    Route::post('/gateways', [GatewayController::class, 'store'])->name('gateways.store')->middleware('checkPermission:gateway_list|gateway_create');
    Route::get('/gateways/{id}/edit', [GatewayController::class, 'edit'])->name('gateways.edit')->middleware('checkPermission:gateway_list|gateway_update');
    Route::post('/gateways/{id}/update', [GatewayController::class, 'update'])->name('gateways.update')->middleware('checkPermission:gateway_list|gateway_update');
    Route::get('/gateways/{id}/destroy', [GatewayController::class, 'destroy'])->name('gateways.destroy')->middleware('checkPermission:gateway_list|gateway_delete');
    Route::get('/gateways/{id}/changeType', [GatewayController::class, 'changeType'])->name('gateways.changeType')->middleware('checkPermission:gateway_list');
    Route::get('/gateways/{id}/changeDefault', [GatewayController::class, 'changeDefault'])->name('gateways.changeDefault')->middleware('checkPermission:gateway_list');
    //------------------------gateways end-------------------------------------
    
    //------------------------Termination RatePlan start-------------------------------------

    //------------------------sofiaRateplan start-------------------------------------------
    Route::get('/sofia-rateplan', [SofiaRateplanController::class, 'index'])->name('sofiaRateplan.index')->middleware('checkPermission:termination_rateplan_list');
    Route::get('/sofia-rateplan/create', [SofiaRateplanController::class, 'create'])->name('sofiaRateplan.create')->middleware('checkPermission:termination_rateplan_list|termination_rateplan_create');
    Route::post('/sofia-rateplan', [SofiaRateplanController::class, 'store'])->name('sofiaRateplan.store')->middleware('checkPermission:termination_rateplan_create|termination_rateplan_list');
    Route::get('/sofia-rateplan/{id}/edit', [SofiaRateplanController::class, 'edit'])->name('sofiaRateplan.edit')->middleware('checkPermission:termination_rateplan_list|termination_rateplan_update');
    Route::post('/sofia-rateplan/{id}/update', [SofiaRateplanController::class, 'update'])->name('sofiaRateplan.update')->middleware('checkPermission:termination_rateplan_list|termination_rateplan_update');
    Route::get('/sofia-rateplan/{id}/destroy', [SofiaRateplanController::class, 'destroy'])->name('sofiaRateplan.destroy')->middleware('checkPermission:termination_rateplan_list|termination_rateplan_delete');
    Route::get('/sofia-rateplan/{id}/changestatus', [SofiaRateplanController::class, 'changeStatus'])->name('sofiaRateplan.changestatus')->middleware('checkPermission:termination_rateplan_list');
    Route::get('/sofia-rateplan/{id}/show', [SofiaRateplanController::class, 'show'])->name('sofiaRateplan.show')->middleware('checkPermission:termination_rateplan_list');
    //------------------------sofiaRateplan end------------------------------------------------------------------

    //------------------------sofiaRate start---------------------------------------------------
    Route::get('/sofia-rate/{id}/index', [SofiaRateController::class, 'index'])->name('sofiaRate.index')->middleware('checkPermission:termination_rate_list');
    Route::get('/sofia-rate/{id}/create', [SofiaRateController::class, 'create'])->name('sofiaRate.create')->middleware('checkPermission:termination_rate_list|termination_rate_create');
    Route::post('/sofia-rate/{id}/store', [SofiaRateController::class, 'store'])->name('sofiaRate.store')->middleware('checkPermission:termination_rate_list|termination_rate_create');
    Route::get('/sofia-rate/{id}/edit', [SofiaRateController::class, 'edit'])->name('sofiaRate.edit')->middleware('checkPermission:termination_rate_list|termination_rate_update');
    Route::post('/sofia-rate/{id}/update', [SofiaRateController::class, 'update'])->name('sofiaRate.update')->middleware('checkPermission:termination_rate_list|termination_rate_update');
    Route::get('/sofia-rate/{id}/destroy', [SofiaRateController::class, 'destroy'])->name('sofiaRate.destroy')->middleware('checkPermission:termination_rate_list|termination_rate_delete');
    Route::get('/sofia-rate/{id}/import', [SofiaRateController::class, 'import'])->name('sofiaRate.import')->middleware('checkPermission:termination_rate_list');
    Route::post('/sofia-rate/{id}/rate_import', [SofiaRateController::class, 'rate_import'])->name('sofiaRate.rate_import')->middleware('checkPermission:termination_rate_list');
    Route::post('/sofia-rate/', [SofiaRateController::class, 'rate_export'])->name('sofiaRate.rate_export')->middleware('checkPermission:termination_rate_list');
    Route::get('/sofia-rate/{id}/downloadFailedCsv', [SofiaRateController::class, 'downloadFailedCsv'])->name('sofiaRate.downloadFailedCsv')->middleware('checkPermission:termination_rate_list');
    Route::get('/sofia-rate/{id}/deleteFailedCsv', [SofiaRateController::class, 'deleteFailedCsv'])->name('sofiaRate.deleteFailedCsv')->middleware('checkPermission:termination_rate_list');
    Route::get('/sofia-rate', [SofiaRateController::class, 'downloadsampleFile'])->name('sofiaRate.downloadsampleFile')->middleware('checkPermission:termination_rate_list');
    //------------------------sofiaRate end----------------------------------------------------

    //------------------------Termination RatePlan end-------------------------------------


    //------------------------Termination Bill Plan start-------------------------------------
    Route::get('/bill-plan', [BillPlanController::class, 'index'])->name('billPlan.index')->middleware('checkPermission:termination_billplan_list');
    Route::get('/bill-plan/create', [BillPlanController::class, 'create'])->name('billPlan.create')->middleware('checkPermission:termination_billplan_list|termination_billplan_create');
    Route::post('/bill-plan', [BillPlanController::class, 'store'])->name('billPlan.store')->middleware('checkPermission:termination_billplan_create|termination_billplan_list');
    Route::get('/bill-plan/{id}/edit', [BillPlanController::class, 'edit'])->name('billPlan.edit')->middleware('checkPermission:termination_billplan_list|termination_billplan_update');
    Route::post('/bill-plan/{id}/update', [BillPlanController::class, 'update'])->name('billPlan.update')->middleware('checkPermission:termination_billplan_list|termination_billplan_update');
    Route::get('/bill-plan/{id}/destroy', [BillPlanController::class, 'destroy'])->name('billPlan.destroy')->middleware('checkPermission:termination_billplan_list|termination_billplan_delete');
    Route::get('/bill-plan/{id}/changestatus', [BillPlanController::class, 'changeStatus'])->name('billPlan.changestatus')->middleware('checkPermission:termination_billplan_list');
    //------------------------Termination Bill Plan end-------------------------------------

    //------------------------services start-------------------------------------
    Route::get('/services', [GatewayController::class, 'index'])->name('services.index')->middleware('checkPermission:service_list');
    Route::get('/services/create', [GatewayController::class, 'create'])->name('services.create')->middleware('checkPermission:service_list|service_create');
    Route::post('/services', [GatewayController::class, 'store'])->name('services.store')->middleware('checkPermission:service_list|service_create');
    Route::get('/services/{id}/edit', [GatewayController::class, 'edit'])->name('services.edit')->middleware('checkPermission:service_list|service_update');
    Route::post('/services/{id}/update', [GatewayController::class, 'update'])->name('services.update')->middleware('checkPermission:service_list|service_update');
    Route::get('/services/{id}/destroy', [GatewayController::class, 'destroy'])->name('services.destroy')->middleware('checkPermission:service_list|service_delete');
    //------------------------services end-------------------------------------
    
    //-----------------------Genaral start-------------------------------------
    Route::get('/country/{id}/get-states', [DidNumberController::class, 'getStates'])->name('gat-states');    
    Route::get('/state/{id}/get-cities', [DidNumberController::class, 'getCities'])->name('gat-cities');    
    //------------------------Genaral start-------------------------------------

    //------------------------numbers start-------------------------------------
    Route::get('/numbers', [DidNumberController::class, 'index'])->name('numbers.index')->middleware('checkPermission:did_number_list');
    Route::get('/numbers/create', [DidNumberController::class, 'create'])->name('numbers.create')->middleware('checkPermission:did_number_list|did_number_create');   
    Route::post('/numbers', [DidNumberController::class, 'store'])->name('numbers.store')->middleware('checkPermission:did_number_list|did_number_create');
    Route::get('/numbers/{id}/edit', [DidNumberController::class, 'edit'])->name('numbers.edit')->middleware('checkPermission:did_number_list|did_number_update');
    Route::post('/numbers/{id}/update', [DidNumberController::class, 'update'])->name('numbers.update')->middleware('checkPermission:did_number_list|did_number_update');
    Route::get('/numbers/{id}/destroy', [DidNumberController::class, 'destroy'])->name('numbers.destroy')->middleware('checkPermission:did_number_list|did_number_delete');
    Route::get('/numbers/{id}/{column}/{value}/update-status', [DidNumberController::class, 'actionUpdatestatus'])->name('numbers.update.status')->middleware('checkPermission:did_number_list|did_number_update');    
    //------------------------numbers end-------------------------------------

    //------------------------import number start-------------------------------------
    Route::get('/numbers/import', [DidNumberImportController::class, 'index'])->name('numbers.import.create')->middleware('checkPermission:did_number_list|did_number_create');
    Route::post('/numbers/import', [DidNumberImportController::class, 'importStore'])->name('numbers.import.store')->middleware('checkPermission:did_number_list|did_number_create');
    Route::get('/file-download', [DidNumberImportController::class, 'fileDownload'])->name('numbers.sample.download')->middleware('checkPermission:did_number_list|did_number_create');
    //------------------------import number end---------------------------------------

    //------------------------Origination Bill Plan start-------------------------------------
    Route::get('/origination-billplan', [OriginationBillPlanController::class, 'index'])->name('originationBillPlan.index')->middleware('checkPermission:origination_bill_list');
    Route::get('/origination-billplan/create', [OriginationBillPlanController::class, 'create'])->name('originationBillPlan.create')->middleware('checkPermission:origination_bill_list|origination_bill_create');
    Route::post('/origination-billplan', [OriginationBillPlanController::class, 'store'])->name('originationBillPlan.store')->middleware('checkPermission:origination_bill_list|origination_bill_create');
    Route::get('/origination-billplan/{id}/edit', [OriginationBillPlanController::class, 'edit'])->name('originationBillPlan.edit')->middleware('checkPermission:origination_bill_list|origination_bill_update');
    Route::post('/origination-billplan/{id}/update', [OriginationBillPlanController::class, 'update'])->name('originationBillPlan.update')->middleware('checkPermission:origination_bill_list|origination_bill_update');
    Route::get('/origination-billplan/{id}/destroy', [OriginationBillPlanController::class, 'destroy'])->name('originationBillPlan.destroy')->middleware('checkPermission:origination_bill_list|origination_bill_delete');
    Route::get('/origination-billplan/{id}/changestatus', [OriginationBillPlanController::class, 'changeStatus'])->name('originationBillPlan.changestatus')->middleware('checkPermission:origination_bill_list');
    //------------------------Origination Bill Plan end-------------------------------------

    //------------------------Did apis start-------------------------------------

    //------------------------vendors start-------------------------------------
    Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index')->middleware('checkPermission:vendor_list|vendor_setting_list');
    Route::get('/vendors/create', [VendorController::class, 'create'])->name('vendors.create')->middleware('checkPermission:vendor_list|vendor_create');   
    Route::post('/vendors', [VendorController::class, 'store'])->name('vendors.store')->middleware('checkPermission:vendor_list|vendor_create');
    Route::get('/vendors/{id}/edit', [VendorController::class, 'edit'])->name('vendors.edit')->middleware('checkPermission:vendor_list|vendor_update');
    Route::post('/vendors/{id}/update', [VendorController::class, 'update'])->name('vendors.update')->middleware('checkPermission:vendor_list|vendor_update');
    Route::get('/vendors/{id}/destroy', [VendorController::class, 'destroy'])->name('vendors.destroy')->middleware('checkPermission:vendor_list|vendor_delete');
    Route::get('/vendors/{id}/{column}/{value}/update-status', [VendorController::class, 'actionUpdatestatus'])->name('vendors.update.status')->middleware('checkPermission:vendor_list|vendor_update'); 
    //------------------------vendors end-------------------------------------

    //------------------------vendor-settings start-------------------------------------
    Route::get('/vendor-settings', [VendorController::class, 'index'])->name('vendor.settings.index')->middleware('checkPermission:vendor_list|vendor_setting_list');
    // Route::get('/vendor-settings', [VendorSettingController::class, 'index'])->name('vendor.settings.index')->middleware('checkPermission:vendor_setting_list');
    Route::get('/vendor-settings/create/{vendor_id}', [VendorSettingController::class, 'create'])->name('vendor.settings.create')->middleware('checkPermission:vendor_setting_list|vendor_setting_create');   
    Route::post('/vendor-settings', [VendorSettingController::class, 'store'])->name('vendor.settings.store')->middleware('checkPermission:vendor_setting_list|vendor_setting_create');
    Route::get('/vendor-settings/{id}/edit/{vendor_id}', [VendorSettingController::class, 'edit'])->name('vendor.settings.edit')->middleware('checkPermission:vendor_setting_list|vendor_setting_update');
    Route::post('/vendor-settings/{id}/update', [VendorSettingController::class, 'update'])->name('vendor.settings.update')->middleware('checkPermission:vendor_setting_list|vendor_setting_update');
    Route::get('/vendor-settings/{id}/destroy/{vendor_id}', [VendorSettingController::class, 'destroy'])->name('vendor.settings.destroy')->middleware('checkPermission:vendor_setting_list|vendor_setting_delete');
    //------------------------vendor-settings start-------------------------------------

    //------------------------Did apis end-------------------------------------

});

