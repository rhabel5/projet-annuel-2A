<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'note',
        'debut',
        'fin',
        'addresse',
        'prix',
        'paye_presta',
        'genre',
        'paye_pcs',
        'description',
        'indications',
        'id_prestataire',
        'id_reservation',
        'id_voyageur',
        'id_bailleur'
    ];
}
