<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleAttributionSeeder extends Seeder
{
    public function run()
    {
        $role = Role::where('name', 'admin')->first();
        if ($role) {
            $role->users()->attach(1);
        }
    
        $role = Role::where('name', 'voyageur')->first();
        if ($role) {
            $role->users()->attach(2);
        }
    
        $role = Role::where('name', 'bailleur')->first();
        if ($role) {
            $role->users()->attach(3);
        }
    
        $role = Role::where('name', 'prestataire')->first();
        if ($role) {
            $role->users()->attach(4);
        }
    }
}