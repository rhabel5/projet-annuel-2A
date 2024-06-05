<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories;

class Equipement_biens extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_bien',
        'id_equipement'
    ];
}
