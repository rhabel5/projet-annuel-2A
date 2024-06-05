<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipementBienTable extends Migration
{
    public function up()
    {
        Schema::create('equipements_biens', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_bien');
            $table->unsignedBigInteger('id_equipement');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipements_biens');
    }
}
