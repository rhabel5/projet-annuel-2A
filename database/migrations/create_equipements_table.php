<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipementTable extends Migration
{
    public function up()
    {
        Schema::create('equipement', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 255);
            $table->unsignedBigInteger('image_url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipement');
    }
}

