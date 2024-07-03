<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestataire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_entreprise',
        'titulaire_compte',
        'adresse_facturation',
        'iban',
        'bic'
    ];
}
