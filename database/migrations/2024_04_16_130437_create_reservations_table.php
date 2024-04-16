<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bien');
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_bailleur');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->unsignedInteger('nb_animaux');
            $table->unsignedInteger('nb_adulte');
            $table->unsignedInteger('nb_enfant');
            $table->string('statut', 60);
            $table->unsignedInteger('prix_total');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
