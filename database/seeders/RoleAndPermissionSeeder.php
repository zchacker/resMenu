<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create-menu']);
        Permission::create(['name' => 'create-orders']);
        Permission::create(['name' => 'create-whatsapp']);
        Permission::create(['name' => 'create-payment']);
        Permission::create(['name' => 'create-social']);        

        $freeRole  = Role::create(['name' => 'freeUser']);
        $paidRole  = Role::create(['name' => 'paidUser']);        
        
        $freeRole->givePermissionTo([
            'create-menu'
        ]);

        $paidRole->givePermissionTo([
            'create-menu',
            'create-orders',
            'create-whatsapp',
            'create-payment',
            'create-social',
        ]);
        
    }
}
