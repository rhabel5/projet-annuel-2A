<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipements_biens extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_bien',
        'id_equipement'
    ];
}
