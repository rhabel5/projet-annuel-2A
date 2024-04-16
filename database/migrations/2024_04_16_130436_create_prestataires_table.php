<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestatairesTable extends Migration
{
    public function up()
    {
        Schema::create('prestataires', function (Blueprint $table) {
            $table->id('id_user');
            $table->unsignedInteger('note_moyenne');
            $table->unsignedBigInteger('id_prestations');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prestataires');
    }
}
