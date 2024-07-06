<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestataire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_entreprise',
        'siret',
        'titulaire_compte',
        'adresse',
        'code_postal',
        'ville',
        'iban',
        'banque',
        'bic'
    ];
}
