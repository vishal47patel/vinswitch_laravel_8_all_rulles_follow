<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    Route::post('updatepassword', [UserController::class, 'submitchangepassword'])->name('users.submitchangepassword');
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
    Route::get('/sofia-rate/{id}', [SofiaRateController::class, 'rate_export'])->name('sofiaRate.rate_export')->middleware('checkPermission:termination_rate_list');
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

    //----------------------------------------------Agent start------------------------------------------------------
    Route::get('/agents', [AgentController::class, 'index'])->name('agent.index')->middleware('checkPermission:agent_list');

    //------------------------Agent Personal Information start----------------------------------------------------
    Route::get('/agents/customer-info', [AgentController::class, 'create'])->name('agent.create')->middleware('checkPermission:agent_list|agent_create');
    Route::post('/agents/account-info', [AgentController::class, 'store'])->name('agent.store')->middleware('checkPermission:agent_list|agent_create');
    Route::get('/agents/{id}/edit', [AgentController::class, 'edit'])->name('agent.edit')->middleware('checkPermission:agent_list|agent_update');
    Route::post('/agent/{id}/update', [AgentController::class, 'update'])->name('agent.update')->middleware('checkPermission:agent_list|agent_update');
    //------------------------Agent Personal Information end----------------------------------------------------

    //------------------------Account Information start----------------------------------------------------
    Route::post('/agents/billing-info', [AgentController::class, 'accountstore'])->name('agent.accountstore')->middleware('checkPermission:agent_list|agent_create');
    Route::post('/agent/{id}/account-update', [AgentController::class, 'account_update'])->name('agent.account_update')->middleware('checkPermission:agent_list|agent_update');
    //------------------------Account Information end----------------------------------------------------

    //------------------------Billing Information start----------------------------------------------------
    Route::post('/agents', [AgentController::class, 'billstore'])->name('agent.billstore')->middleware('checkPermission:agent_list|agent_create');
    Route::post('/agents/add-commission', [AgentController::class, 'addcommission'])->name('agent.addcommission')->middleware('checkPermission:agent_list|agent_create');
    Route::get('/agents/delete-commission', [AgentController::class, 'deletecommission'])->name('agent.deletecommission')->middleware('checkPermission:agent_list|agent_create');
    Route::post('/agents/{id}/add-billplan', [AgentController::class, 'addbillplan'])->name('agent.addbillplan')->middleware('checkPermission:agent_list|agent_create');
    Route::post('/agents/{id}/display-billplan', [AgentController::class, 'displaybillplan'])->name('agent.displaybillplan')->middleware('checkPermission:agent_list|agent_create');
    Route::get('/agents/delete-billplan', [AgentController::class, 'deletebillplan'])->name('agent.deletebillplan')->middleware('checkPermission:agent_list|agent_create');
    Route::post('/agents/edit-commission', [AgentController::class, 'editcommission'])->name('agent.editcommission')->middleware('checkPermission:agent_list|agent_create');
    //------------------------Billing Information end----------------------------------------------------

    //------------------------Agent Commission start----------------------------------------------------
    Route::get('/agent-commission/{id}', [AgentCommissionController::class, 'index'])->name('agentCommission.index')->middleware('checkPermission:agent_list');
    Route::get('/agent-commission/{id}/create', [AgentCommissionController::class, 'create'])->name('agentCommission.create')->middleware('checkPermission:agent_list');
    Route::post('/agent-commission/{id}', [AgentCommissionController::class, 'store'])->name('agentCommission.store')->middleware('checkPermission:agent_list');

    //------------------------Agent Commission end----------------------------------------------------

    Route::get('/agents/{id}/view-tenant', [AgentController::class, 'viewtenant'])->name('agent.viewtenant')->middleware('checkPermission:agent_list');
    Route::get('/agents/{id}/tenantchangesuspended', [AgentController::class, 'tenantchangesuspended'])->name('agent.tenantchangesuspended')->middleware('checkPermission:agent_list');

    
    Route::get('/agents/{id}/resetpassword', [AgentController::class, 'resetpassword'])->name('agent.resetpassword')->middleware('checkPermission:agent_list');
    Route::post('/agents/{id}/resetpassword', [AgentController::class, 'agentresetpassword'])->name('agent.agentresetpassword')->middleware('checkPermission:agent_list');

    Route::get('/agents/{id}/changestatus', [AgentController::class, 'changestatus'])->name('agent.changestatus')->middleware('checkPermission:agent_list');
    Route::get('/agents/{id}/changesuspended', [AgentController::class, 'changesuspended'])->name('agent.changesuspended')->middleware('checkPermission:agent_list');
    //-------------------------------------------------Agent end---------------------------------------------------------

    //------------------------Origination Rate Plan start-------------------------------------
    Route::get('/origination-rateplan', [OriginationRatePlanController::class, 'index'])->name('origination_rateplan.index')->middleware('checkPermission:origination_rate_plan_list'); 
    Route::get('/origination-rateplan/create', [OriginationRatePlanController::class, 'create'])->name('origination_rateplan.create')->middleware('checkPermission:origination_rate_plan_create|origination_rate_plan_list');
    Route::post('/origination-rateplan', [OriginationRatePlanController::class, 'store'])->name('origination_rateplan.store')->middleware('checkPermission:origination_rate_plan_create|origination_rate_plan_list');
    Route::get('/origination-rateplan/{id}/edit', [OriginationRatePlanController::class, 'edit'])->name('origination_rateplan.edit')->middleware('checkPermission:origination_rate_plan_update|origination_rate_plan_list');
    Route::post('/origination-rateplan/{id}/update', [OriginationRatePlanController::class, 'update'])->name('origination_rateplan.update')->middleware('checkPermission:origination_rate_plan_update|origination_rate_plan_list');
    Route::get('/origination-rateplan/{id}/destroy', [OriginationRatePlanController::class, 'destroy'])->name('origination_rateplan.destroy')->middleware('checkPermission:origination_rate_plan_delete|origination_rate_plan_list');
    Route::get('/origination-rateplan/{id}/show', [OriginationRatePlanController::class, 'show'])->name('origination_rateplan.show')->middleware('checkPermission:origination_rate_plan_view|origination_rate_plan_list');

    //------------------------Acl start-------------------------------------

    Route::get('/aclnodes', [AclNodesController::class, 'index'])->name('aclnodes.index')->middleware('checkPermission:aclnodes_list');
    Route::get('/aclnodes/create', [AclNodesController::class, 'create'])->name('aclnodes.create')->middleware('checkPermission:aclnodes_list|aclnodes_create');
    Route::post('/aclnodes', [AclNodesController::class, 'store'])->name('aclnodes.store')->middleware('checkPermission:aclnodes_list|aclnodes_create');
    Route::get('/aclnodes/{id}/change-type', [AclNodesController::class, 'changeType'])->name('aclnodes.changeType')->middleware('checkPermission:aclnodes_list');
    Route::get('/aclnodes/{id}/edit', [AclNodesController::class, 'edit'])->name('aclnodes.edit')->middleware('checkPermission:aclnodes_list|aclnodes_update');
    Route::post('/aclnodes/{id}/update', [AclNodesController::class, 'update'])->name('aclnodes.update')->middleware('checkPermission:aclnodes_list|aclnodes_update');
    Route::get('/aclnodes/{id}/destroy', [AclNodesController::class, 'destroy'])->name('aclnodes.destroy')->middleware('checkPermission:aclnodes_list|aclnodes_delete');
    
    //------------------------Acl end-------------------------------------

     //------------------------NpaNxxMaster start-------------------------------------
     Route::get('/npanxx-master', [NpaNxxMasterController::class, 'index'])->name('npaNxxMaster.index')->middleware('checkPermission:npaNxxMaster_list'); 
     Route::get('/npanxx-master/create', [NpaNxxMasterController::class, 'create'])->name('npaNxxMaster.create')->middleware('checkPermission:npaNxxMaster_create|npaNxxMaster_list');
     Route::post('/npanxx-master', [NpaNxxMasterController::class, 'store'])->name('npaNxxMaster.store')->middleware('checkPermission:npaNxxMaster_create|npaNxxMaster_list');
     Route::get('/npanxx-master/{id}/edit', [npaNxxMasterController::class, 'edit'])->name('npaNxxMaster.edit')->middleware('checkPermission:npaNxxMaster_update|npaNxxMaster_list');
     Route::post('/npanxx-master/{id}/update', [npaNxxMasterController::class, 'update'])->name('npaNxxMaster.update')->middleware('checkPermission:npaNxxMaster_update|npaNxxMaster_list');
     Route::get('/npanxx-master/{id}/show', [npaNxxMasterController::class, 'show'])->name('npaNxxMaster.show')->middleware('checkPermission:npaNxxMaster_show|npaNxxMaster_list');
     Route::get('/npanxx-master/{id}/destroy', [npaNxxMasterController::class, 'destroy'])->name('npaNxxMaster.destroy')->middleware('checkPermission:npaNxxMaster_delete|npaNxxMaster_list');
     //------------------------NpaNxxMaster end-------------------------------------
    
     //------------------------NPA/NXXDetail start-------------------------------------
     
     Route::get('/npanxx-Detail/{id}', [NpaNxxDetailController::class, 'index'])->name('NpaNxxDetail.index')->middleware('checkPermission:NpaNxxDetail_list'); 
     Route::get('/npanxx-Detail/{id}/import', [NpaNxxDetailController::class, 'import'])->name('NpaNxxDetail.import')->middleware('checkPermission:NpaNxxDetail_list');
     Route::post('/npanxx-Detail/{id}/store', [NpaNxxDetailController::class, 'store'])->name('NpaNxxDetail.store')->middleware('checkPermission:NpaNxxDetail_list');  
     Route::get('/downloadfile', [NpaNxxDetailController::class, 'downloadfile'])->name('NpaNxxDetail.downloadfile')->middleware('checkPermission:NpaNxxDetail_list');  
     Route::get('/npanxx-Detail/{id}/destroy', [NpaNxxDetailController::class, 'destroy'])->name('NpaNxxDetail.destroy')->middleware('checkPermission:NpaNxxDetail_delete|NpaNxxDetail_list');
     //------------------------NPA/NXXDetail end-------------------------------------

    //------------------------Customer start-------------------------------------
    Route::get('/tenants', [TenantController::class, 'index'])->name('tenant.index')->middleware('checkPermission:tenant_list');
    Route::get('/tenants/customer-info', [TenantController::class, 'create'])->name('tenant.create')->middleware('checkPermission:tenant_list|tenant_create');
    Route::post('/tenants/account-info', [TenantController::class, 'store'])->name('tenant.store')->middleware('checkPermission:tenant_list|tenant_create');
    Route::post('/tenants/fetch-state', [TenantController::class, 'fetchstate'])->name('tenant.fetchstate')->middleware('checkPermission:tenant_list|tenant_create');
    Route::get('/tenants/{id}/edit', [TenantController::class, 'edit'])->name('tenant.edit')->middleware('checkPermission:tenant_list|tenant_update');
    Route::post('/tenants/{id}/update', [TenantController::class, 'update'])->name('tenant.update')->middleware('checkPermission:tenant_list|tenant_update');

    //------------------------Account Information start----------------------------------------------------
    Route::post('/tenants/billing-info', [TenantController::class, 'accountstore'])->name('tenant.accountstore')->middleware('checkPermission:tenant_list|tenant_create');
    Route::post('/tenants/{id}/account-update', [TenantController::class, 'account_update'])->name('tenant.account_update')->middleware('checkPermission:tenant_list|tenant_update');
    //------------------------Account Information end----------------------------------------------------


    //------------------------Billing Information start----------------------------------------------------
    Route::post('/tenants', [TenantController::class, 'billstore'])->name('tenant.billstore')->middleware('checkPermission:tenant_list|tenant_create');
    Route::get('/tenants/loadbillplan', [TenantController::class, 'loadbillplan'])->name('tenant.loadbillplan')->middleware('checkPermission:tenant_list');
    //------------------------Billing Information start----------------------------------------------------

    Route::get('/tenants/{id}/resetpassword', [TenantController::class, 'resetpassword'])->name('tenant.resetpassword')->middleware('checkPermission:tenant_list');
    Route::post('/tenants/{id}/resetpassword', [TenantController::class, 'tenantresetpassword'])->name('tenant.tenantresetpassword')->middleware('checkPermission:tenant_list');


    //------------------------Customer end-------------------------------------
 
      //------------------------DID Service Type start-------------------------------------
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index')->middleware('checkPermission:service_list'); 
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create')->middleware('checkPermission:service_create|service_list');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store')->middleware('checkPermission:service_create|service_list');
    Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit')->middleware('checkPermission:service_update|service_list');
    Route::post('/services/{id}/update', [ServiceController::class, 'update'])->name('services.update')->middleware('checkPermission:service_update|service_list');
    Route::get('/services/{id}/destroy', [ServiceController::class, 'destroy'])->name('services.destroy')->middleware('checkPermission:service_delete|service_list');
    //------------------------DID Service Type end-------------------------------------

    // -------------------------- Live Call ------------------------------- 
    Route::get('/activecall', [ActiveCallController::class, 'index'])->name('cdr.activecall')->middleware('checkPermission:live_calls_list'); 
    Route::get('/cdr/getactivecall', [ActiveCallController::class, 'getActiveCall'])->name('cdr.getActiveCall');
    Route::get('/cdr/call/hangup', [ActiveCallController::class, 'hangup'])->name('cdr.call.hangup');

    //------------------------Freeswitch Server start-------------------------------------
    Route::get('/freeswitch-server', [FreeswitchServerController::class, 'index'])->name('freeswitchServer.index')->middleware('checkPermission:freeswitch_server_list'); 
    Route::get('/freeswitch-server/create', [FreeswitchServerController::class, 'create'])->name('freeswitchServer.create')->middleware('checkPermission:freeswitch_server_create|freeswitch_server_list');
    Route::post('/freeswitch-server', [FreeswitchServerController::class, 'store'])->name('freeswitchServer.store')->middleware('checkPermission:freeswitch_server_create|freeswitch_server_list');
    Route::get('/freeswitch-server/{id}/edit', [FreeswitchServerController::class, 'edit'])->name('freeswitchServer.edit')->middleware('checkPermission:freeswitch_server_update|freeswitch_server_list');
    Route::post('/freeswitch-server/{id}/update', [FreeswitchServerController::class, 'update'])->name('freeswitchServer.update')->middleware('checkPermission:freeswitch_server_update|freeswitch_server_list');
    Route::get('/freeswitch-server/{id}/destroy', [FreeswitchServerController::class, 'destroy'])->name('freeswitchServer.destroy')->middleware('checkPermission:freeswitch_server_delete|freeswitch_server_list');
    //------------------------Freeswitch Server end-------------------------------------

    //------------------------Registered SIP Devices start-------------------------------------
    Route::get('/registrations', [RegistrationsController::class, 'index'])->name('registrations.index'); 
    Route::get('/registration/list', [RegistrationsController::class, 'registration'])->name('registrations.registration'); 
    Route::get('/registrations/unregister', [RegistrationsController::class, 'unregister'])->name('registrations.unregister'); 
    //------------------------Registered SIP Devices end-------------------------------------

      //------------------------Taxation start-------------------------------------
    Route::get('/taxation', [TaxationController::class, 'index'])->name('taxation.index')->middleware('checkPermission:taxation_list'); 
    Route::get('/taxation/create', [TaxationController::class, 'create'])->name('taxation.create')->middleware('checkPermission:taxation_create|taxation_list');
    Route::post('/taxation', [TaxationController::class, 'store'])->name('taxation.store')->middleware('checkPermission:taxation_create|taxation_list');
    Route::get('/taxation/{id}/edit', [TaxationController::class, 'edit'])->name('taxation.edit')->middleware('checkPermission:taxation_update|taxation_list');
    Route::post('/taxation/{id}/update', [TaxationController::class, 'update'])->name('taxation.update')->middleware('checkPermission:taxation_update|taxation_list');
    Route::get('/taxation/{id}/destroy', [TaxationController::class, 'destroy'])->name('taxation.destroy')->middleware('checkPermission:taxation_delete|taxation_list');
       //------------------------Taxation end-------------------------------------


    //------------------------Taxation start-------------------------------------
    Route::get('/order', [OrderController::class, 'index'])->name('order.index')->middleware('checkPermission:order_list'); 
    Route::get('/order/{id}/view', [OrderController::class, 'show'])->name('order.show')->middleware('checkPermission:order_list'); 
    //------------------------Taxation end-------------------------------------
    
    Route::get('/switchcli', [SwitchcliController::class, 'index'])->name('switchcli.index')->middleware('checkPermission:switchcli');
    Route::get('/switchcli/list', [SwitchcliController::class, 'getswitchcli'])->name('switchcli.list');

    // -------------------------- registeredgatewey start  ------------------------------- 
    Route::get('/registeredgatewey', [RegisteredgateweyController::class, 'index'])->name('registeredgatewey.index')->middleware('checkPermission:live_registered_gatewey'); 
    Route::get('/registeredgatewey/list', [RegisteredgateweyController::class, 'getRegisteredgatewey'])->name('registeredgatewey.list');
    // -------------------------- registeredgatewey end  ------------------------------- 

    //------------------------sip-profile start-------------------------------------
    Route::get('/sip-status', [SofiaConfController::class, 'index'])->name('sip.status.index')->middleware('checkPermission:sip_status_list');    
    Route::get('/sip-status/cmd/{cmd}', [SofiaConfController::class, 'cmd'])->name('sip.status.cmd')->middleware('checkPermission:sip_status_list');    
    //------------------------sip-profile end---------------------------------------
    
    //------------------------sip-profile start-------------------------------------
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index')->middleware('checkPermission:payment_list|payment_create');    
    Route::post('/payments/credit-debit', [PaymentController::class, 'creditDebit'])->name('payments.creditdebit')->middleware('checkPermission:payment_list|payment_create');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create')->middleware('checkPermission:payment_list|payment_create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store')->middleware('checkPermission:payment_list|payment_create');    
    //------------------------sip-profile end---------------------------------------
});

