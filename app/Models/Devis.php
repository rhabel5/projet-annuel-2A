<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_prestataire',
        'id_bailleur',
        'id_reservation',
        'id_prestation',
        'prix_total',
        'etat'

    ];
}
