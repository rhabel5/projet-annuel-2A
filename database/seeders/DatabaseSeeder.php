<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Bien;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Vérifier et créer les rôles s'ils n'existent pas déjà
        $roles = ['admin', 'voyageur', 'prestataire', 'bailleur'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Supprimer l'utilisateur s'il existe déjà
        $existingUser = User::where('email', 'rayane.habel@gmail.com')->first();
        if ($existingUser) {
            $existingUser->delete();
        }

        // Créer un utilisateur spécifique
        $user = User::create([
            'firstname' => 'Rayane',
            'lastname' => 'Habel',
            'email' => 'rayane.habel@gmail.com',
            'password' => Hash::make('Azerty01'),
            'tel' => '0619978791',
            'birthdate' => '2004-01-05', // Ajouter la date de naissance
        ]);
        $user->roles()->attach(Role::where('name', 'admin')->first());

        // Créer des utilisateurs aléatoires
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {
            $user = User::create([
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), // mot de passe par défaut
                'tel' => $faker->phoneNumber,
                'birthdate' => $faker->date(), // Ajouter la date de naissance
            ]);

            // Assigner des rôles aléatoires
            $roles = Role::all()->random(rand(1, 4))->pluck('id')->toArray();
            $user->roles()->attach($roles);

            // Créer des biens aléatoires pour les utilisateurs avec le rôle 'bailleur'
            if (in_array(Role::where('name', 'bailleur')->first()->id, $roles)) {
                for ($j = 0; $j < rand(1, 5); $j++) {
                    Bien::create([
                        'id_bailleur' => $user->id,
                        'titre' => $faker->words(3, true),
                        'description' => $faker->sentence,
                        'couchage' => $faker->numberBetween(1, 10),
                        'type_bien' => $faker->randomElement(['villa', 'appartement', 'maison']),
                        'type_location' => $faker->randomElement(['vacances', 'longue durée']),
                        'ville' => $faker->city,
                        'adresse' => $faker->address,
                        'code_postal' => $faker->numberBetween(10000, 99999), // Utiliser un code postal valide
                        'prix_adulte' => $faker->numberBetween(50, 500),
                        'prix_enfant' => $faker->numberBetween(30, 300),
                        'prix_animaux' => $faker->numberBetween(10, 100),
                        'nb_lit' => $faker->numberBetween(1, 10),
                        'piscine' => $faker->boolean,
                        'note_moyenne' => $faker->numberBetween(1, 5),
                        'salle_eau' => $faker->numberBetween(1, 5),
                        'image_url' => $faker->imageUrl(640, 480, 'houses', true),
                        'nb_chambres' => $faker->numberBetween(1, 10),
                        'dispo' => $faker->numberBetween(0, 1),
                        'valide' => $faker->boolean,
                    ]);
                }
            }
        }
    }
}