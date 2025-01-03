<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referrals extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'start_date' => 'datetime',
    ];

    protected $fillable = [
        'type',
        'received_to',
        'referralstatus',
        'address',
        'telephone',
        'email',
        'comments',
        'user_id'
    ];

    // Relation to User
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function received()
    {
        return $this->belongsTo(User::class, 'received_to', 'id');
    }
    
    // public function referralsuser()
    // {
    //     return $this->belongsTo(Referrals::class, 'user_id', 'id');
    // }
    // public function referralsreceived()
    // {
    //     return $this->belongsTo(Referrals::class, 'received_to', 'id');
    // }
    
}

