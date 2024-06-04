<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    use HasFactory;

    protected $table = 'biens';

    protected $fillable = [
        'id_bailleur',
        'nom_bien',
        'description',
        'couchage',
        'type_bien',
        'type_location',
        'ville',
        'adresse',
        'code_postal',
        'prix_adulte',
        'prix_enfant',
        'prix_animaux',
        'nb_lit',
        'piscine',
        'note_moyenne',
        'salle_eau',
        'images',
        'nb_chambres',
        'dispo',
        'valide',
        'image_url',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_bien');
    }

}