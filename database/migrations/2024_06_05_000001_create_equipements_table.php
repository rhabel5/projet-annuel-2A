<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipementsTable extends Migration
{
    public function up()
    {
        Schema::create('equipements', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 255);
            $table->string('image_url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipement');
    }
}

