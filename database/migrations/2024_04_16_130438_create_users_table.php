<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->string('surname', 60);
            $table->string('email', 60)->unique();
            $table->date('birth_date');
            $table->string('password', 60);
            $table->string('phone', 60);
            $table->string('role', 60);

            // ATTRIBUTS VOYAGEURS
            $table->boolean('vip')->nullable();//vip ou non


            // ATTRIBUTS BAILLEURS
            $table->string('rib', 60)->nullable(); //où il recevra ses payement
            $table->string('prestataire_favoris')->nullable();// Liste des prestataires favoris
            $table->string('voyageurs_bloques')->nullable();// Liste des voyageurs bloquées

            //ATTRIBUTS PRESTATAIRES
            $table->integer('rating')->nullable();//note moyenne du presta
            $table->string('availability', 60)->nullable();//disponibilité du presta

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
