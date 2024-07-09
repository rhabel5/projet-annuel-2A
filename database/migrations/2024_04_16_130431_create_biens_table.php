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
            $table->string('titre', 60);
            $table->unsignedBigInteger('id_bailleur');
            $table->string('description', 255);
            $table->unsignedInteger('couchage');
            $table->string('type_bien', 60);
            $table->string('ville', 60);
            $table->string('adresse', 255);
            $table->unsignedInteger('code_postal');
            $table->unsignedInteger('prix_adulte');
            $table->unsignedInteger('prix_enfant');
            $table->unsignedInteger('prix_animaux');
            $table->unsignedInteger('nb_lit');
            $table->boolean('piscine');
            $table->unsignedInteger('note_moyenne')->nullable();
            $table->unsignedInteger('salle_eau');
            $table->string('image_url', 255)->nullable();
            $table->unsignedInteger('images')->nullable();
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
