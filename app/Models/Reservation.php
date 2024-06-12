<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_client',
        'id_bien',
        'id_bailleur',
        'date_debut',
        'date_fin',
        'nb_adulte',
        'prix_total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bien()
    {
        return $this->belongsTo(Bien::class, 'id_bien');
    }
}
