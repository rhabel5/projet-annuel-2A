<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_bailleur',
        'titre' ,
        'description' ,
        'couchage' ,
        'type_bien' ,
        'type_location',
        'ville' ,
        'adresse' ,
        'code_postal',
        'prix_adulte' ,
        'prix_enfant' ,
        'prix_animaux' ,
        'nb_lit'  ,
        'piscine',
        'note_moyenne',
        'salle_eau',
        'images'  ,
        'nb_chambres' ,
        'dispo',
        'valide'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_bien');
    }

}
