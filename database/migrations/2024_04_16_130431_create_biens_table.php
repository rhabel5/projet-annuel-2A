<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiensTable extends Migration
{
    public function up()
    {
        Schema::create('biens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bailleur');
            $table->string('nom_bien', 60);
            $table->string('description', 255);
            $table->unsignedInteger('couchage');
            $table->string('type_bien', 60);
            $table->string('type_location', 60);
            $table->string('ville', 60);
            $table->string('adresse', 255);
            $table->unsignedInteger('code_postal');
            $table->unsignedInteger('prix_adulte');
            $table->unsignedInteger('prix_enfant');
            $table->unsignedInteger('prix_animaux');
            $table->unsignedInteger('nb_lit');
            $table->boolean('piscine');
            $table->unsignedInteger('note_moyenne');
            $table->unsignedInteger('salle_eau');
            $table->unsignedInteger('images');
            $table->unsignedInteger('nb_chambres');
            $table->unsignedInteger('dispo');
            $table->boolean('valide')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('biens');
    }
}