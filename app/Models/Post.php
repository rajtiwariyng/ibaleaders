<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'start_date' => 'datetime',
    ];

    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
        'post_for',
        'status',
    ];

    // Relation to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

