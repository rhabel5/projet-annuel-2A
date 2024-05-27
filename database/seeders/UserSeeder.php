<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'firstname' => 'Admin',
                'lastname' => 'User',
                'email' => 'admin@example.com',
                'birthdate' => '1980-01-01',
                'password' => Hash::make('password'),
                'tel' => '0101010101',
                'role' => 'admin'
            ],
            [
                'firstname' => 'Voyageur',
                'lastname' => 'User',
                'email' => 'voyageur@example.com',
                'birthdate' => '1990-01-01',
                'password' => Hash::make('password'),
                'tel' => '0101010102',
                'role' => 'voyageur'
            ],
            [
                'firstname' => 'Bailleur',
                'lastname' => 'User',
                'email' => 'bailleur@example.com',
                'birthdate' => '1995-01-01',
                'password' => Hash::make('password'),
                'tel' => '0101010103',
                'role' => 'bailleur'
            ],
            [
                'firstname' => 'Prestataire',
                'lastname' => 'User',
                'email' => 'prestataire@example.com',
                'birthdate' => '1985-01-01',
                'password' => Hash::make('password'),
                'tel' => '0101010104',
                'role' => 'prestataire'
            ],
            [
                'firstname' => 'Regular',
                'lastname' => 'User',
                'email' => 'regular@example.com',
                'birthdate' => '2000-01-01',
                'password' => Hash::make('password'),
                'tel' => '0101010105',
                'role' => 'voyageur'
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'firstname' => $userData['firstname'],
                'lastname' => $userData['lastname'],
                'email' => $userData['email'],
                'birthdate' => $userData['birthdate'],
                'password' => $userData['password'],
                'tel' => $userData['tel'],
            ]);

            $role = Role::where('name', $userData['role'])->first();
            $user->roles()->attach($role);
        }
    }
}