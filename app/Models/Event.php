<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'start_date' => 'datetime',
    ];

    protected $fillable = [
        'name',
        'location',
        'start_date',
        'user_id',
        'status',
    ];

    // Relation to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

