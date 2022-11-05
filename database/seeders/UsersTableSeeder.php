<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
    
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $users = [
            'tenant_id' => null,
            'username' => 'admin',
            'role_id' => '1',
            'role' => 'ADMIN',
            'firstname' => 'VSPL',
            'lastname' => 'Switch',
            'name' => 'VSPL Switch',
            'phoneno' => '1234567890',
            'email' => 'ashvini@vindaloosofttech.com',
            'superuser' => 1, 
            'status' => 'ENABLED',
            'password' => bcrypt('123456')
        ];
        DB::table('user')->insert($users);
    }
}
