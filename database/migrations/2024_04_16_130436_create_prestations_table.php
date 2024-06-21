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
            $table->string('nom');
            $table->string('type');
            $table->string('note');
            $table->dateTime('debut');
            $table->dateTime('fin');
            $table->string('description');
            $table->string('indications');
            $table->unsignedBigInteger('id_prestataire');
            $table->unsignedInteger('id_reservation');
            $table->id('id_voyageur');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prestataires');
    }
}
