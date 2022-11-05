<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permission_role')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $permissions = [
            ['name' => 'user_list'],
            ['name' => 'user_create'],
            ['name' => 'user_update'],
            ['name' => 'user_delete'],
            ['name' => 'role_list'],
            ['name' => 'role_create'],
            ['name' => 'role_update'],
            ['name' => 'role_delete'],
            ['name' => 'lead_list'],
            ['name' => 'user_profile'],
            ['name' => 'user_change_password'],
            ['name' => 'gateway_list'],
            ['name' => 'gateway_create'],
            ['name' => 'gateway_update'],
            ['name' => 'gateway_delete'],
            ['name' => 'termination_billplan_list'],
            ['name' => 'termination_billplan_create'],
            ['name' => 'termination_billplan_update'],
            ['name' => 'termination_billplan_delete'],
            ['name' => 'termination_rateplan_list'],
            ['name' => 'termination_rateplan_create'],
            ['name' => 'termination_rateplan_update'],
            ['name' => 'termination_rateplan_delete'],
            ['name' => 'service_create'],
            ['name' => 'service_list'],
            ['name' => 'service_update'],
            ['name' => 'service_delete'],            
            ['name' => 'termination_rate_list'],
            ['name' => 'termination_rate_create'],
            ['name' => 'termination_rate_update'],
            ['name' => 'termination_rate_delete'],
            ['name' => 'origination_bill_list'],
            ['name' => 'origination_bill_create'],
            ['name' => 'origination_bill_update'],
            ['name' => 'origination_bill_delete'],
            ['name' => 'did_number_create'],
            ['name' => 'did_number_list'],
            ['name' => 'did_number_update'],
            ['name' => 'did_number_delete'],
            ['name' => 'npaNxxMaster_list'],
            ['name' => 'npaNxxMaster_create'],
            ['name' => 'npaNxxMaster_update'],
            ['name' => 'npaNxxMaster_delete'],
            ['name' => 'npa_nxx_detail_list'],
            ['name' => 'npa_nxx_detail_import'],
            ['name' => 'npa_nxx_detail_delete'],            
            ['name' => 'vendor_list'],
            ['name' => 'vendor_create'],
            ['name' => 'vendor_update'],
            ['name' => 'vendor_delete'],
            ['name' => 'vendor_setting_list'],
            ['name' => 'vendor_setting_create'],
            ['name' => 'vendor_setting_update'],
            ['name' => 'vendor_setting_delete'],           
        ];
        DB::table('permissions')->insert($permissions);
        
        $permissionIds = Permission::pluck('id')->toArray();
        $role = Role::findorfail(1);
        $role->permissions()->attach($permissionIds);

    }
}
