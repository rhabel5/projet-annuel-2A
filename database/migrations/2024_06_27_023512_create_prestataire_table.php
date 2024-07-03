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
            $table->id('id_prestataire');
            $table->string('nom_entreprise');
            $table->string('titulaire_compte');
            $table->string('adresse_facturation');
            $table->string('iban')->unique();
            $table->string('bic')->unique();
            $table->timestamps();

            // Définir la clé étrangère avec un nom différent de id_prestataire
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
