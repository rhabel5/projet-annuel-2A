<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestationsTable extends Migration
{
    public function up()
    {
        Schema::create('prestations', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->boolean('genre');
            $table->string('note');
            $table->string('adresse');
            $table->dateTime('debut');
            $table->dateTime('fin');
            $table->string('description');
            $table->string('indications');
            $table->float('prix')->nullable();
            $table->float('paye_presta')->nullable();
            $table->float('paye_pcs')->nullable();
            $table->unsignedBigInteger('id_prestataire');
            $table->unsignedInteger('id_reservation');
            $table->id('id_voyageur');
            $table->id('id_bailleur');
            $table->id('id_bien')->nullable();
            $table->string('state');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prestataires');
    }
}
