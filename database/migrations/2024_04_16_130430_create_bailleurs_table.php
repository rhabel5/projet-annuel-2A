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
            $table->unsignedBigInteger('biens');//listes des biens
            $table->string('prestataire_favoris');//liste des prestataires favoris
            $table->string('voyageurs_bloques');//liste des voyageurs bloquées
            $table->string('compte_bancaire', 60); //où il recevra ses payement
            $table->string('siret', 60);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bailleurs');
    }
}
