<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicheIntervention extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_prestataire',
        'id_prestation',
        'id_bien',
        'id_bailleur',
        'description',
        'problemes',
        'realisee',
    ];
}
