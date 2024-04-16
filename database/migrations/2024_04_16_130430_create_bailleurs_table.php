<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBailleursTable extends Migration
{
    public function up()
    {
        Schema::create('bailleurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('biens');
            $table->unsignedBigInteger('id_prestations');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bailleurs');
    }
}
