<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $roles = ['admin', 'voyageur', 'prestataire', 'bailleur'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    
        $user = User::create([
            'firstname' => 'Rayane',
            'lastname' => 'Habel',
            'email' => 'rayane.habel@gmail.com',
            'password' => bcrypt('Azerty01'),
            'tel' => '0619978791',
        ]);
    
        $user->roles()->attach(Role::where('name', 'admin')->first());
    }
}