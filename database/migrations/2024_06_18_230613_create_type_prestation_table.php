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
        Schema::create('type_prestations', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 60);
            $table->string('description', 255);
            $table->integer('prix_moyen');
            $table->integer('pourcentage_pcs');
            $table->string('prerequis', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_prestations');
    }
};
