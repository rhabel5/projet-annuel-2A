<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bien');
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_bailleur');
            $table->unsignedBigInteger('id_prestations');
            $table->unsignedInteger('prix_location');
            $table->unsignedInteger('prix_prestations');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('factures');
    }
}
