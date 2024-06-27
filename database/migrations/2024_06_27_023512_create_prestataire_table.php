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
        Schema::create('prestataire', function (Blueprint $table) {
            $table->id();
            $table->nom_entreprise();
            $table->titulaire_compte();
            $table->adresse_facturation();
            $table->iban();
            $table->bic();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestataire');
    }
};
