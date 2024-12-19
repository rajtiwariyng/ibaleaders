<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'start_date' => 'datetime',
    ];

    protected $fillable = [
        'title',
        'author',
        'type',
        'description',
        'user_id',
        'status',
        'received_to'
    ];

    // Relation to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

