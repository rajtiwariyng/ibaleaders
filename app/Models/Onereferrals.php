<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Onereferrals extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'start_date' => 'datetime',
    ];

    protected $fillable = [
        'received_to',
        'location',
        'conversation',
        'start_date',
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
    // public function tyfcbreferralsuser()
    // {
    //     return $this->belongsTo(Tyfcbreferrals::class, 'user_id', 'id');
    // }
    // public function tyfcbreferralsreceived()
    // {
    //     return $this->belongsTo(Tyfcbreferrals::class, 'received_to', 'id');
    // }
}