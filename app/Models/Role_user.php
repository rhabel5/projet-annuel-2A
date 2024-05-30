<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role_user extends Model
{
    protected $table = 'role_user';

    // Spécifiez les champs modifiables
    protected $fillable = ['id_role', 'id_user'];
}

