<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fiches_interventions', function (Blueprint $table) {
            $table->id();
            $table->integer('id_prestataire');
            $table->integer('id_prestation');
            $table->integer('id_bien');
            $table->integer('id_bailleur');
            $table->text('description');
            $table->text('problemes');
            $table->text('realisee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiche_intervention');
    }
};
