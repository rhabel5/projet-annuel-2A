<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementDevis extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
        'quantite',
        'prixunite',
        'prixtotal',
        'devis_id'
    ];
}
