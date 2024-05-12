<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBailleursTable extends Migration
{
    public function up()
    {
        Schema::create('bailleurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Clé étrangère vers la table users
            $table->string('prestataire_favoris')->nullable();//liste des prestataires favoris
            $table->string('voyageurs_bloques')->nullable();//liste des voyageurs bloquées
            $table->string('rib', 60); //où il recevra ses payement
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bailleurs');
    }
}
