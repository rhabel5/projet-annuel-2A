<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
        'status',
        'priority',
        'user_id',
        'assigned_to'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function responses()
    {
        return $this->hasMany(TicketResponse::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'ticket_tag');
    }
}