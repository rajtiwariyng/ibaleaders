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
<<<<<<< HEAD
        'post_for',
=======
>>>>>>> a8445b326f46709240e0003560090eb0de4ee731
        'status',
    ];

    // Relation to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

