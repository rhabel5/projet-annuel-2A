<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoyageursTable extends Migration
{

    public function up()
    {
        Schema::create('voyageurs', function (Blueprint $table) {
            $table->id();
            $table->string('reservations_passe', 255);
            $table->unsignedBigInteger('reservation_futur');
            $table->unsignedBigInteger('reservation_en_cours');
            $table->boolean('vip');
            $table->unsignedBigInteger('commentaires');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('voyageurs');
    }
}
