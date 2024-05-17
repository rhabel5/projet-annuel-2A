<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestationsTable extends Migration
{
    public function up()
    {
        Schema::create('prestations', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nom');
            $table->string('type');
            $table->string('note');
            $table->string('date');
            $table->string('description');
            $table->unsignedBigInteger('id_prestataire');
            $table->unsignedInteger('id_reservation');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prestataires');
    }
}
