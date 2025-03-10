<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
     use HasFactory, Notifiable, HasRoles, SoftDeletes,HasApiTokens;
     
     //protected $guard_name = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'industry',
        'mobile_number',
        'address',
        'city',
        'state',
        'pin_code',
        'brand_name',
        'brand_logo',
        'business_bio',
        'keywords',
        'years_in_business',
        'previous_jobs',
        'spouse',
        'children',
        'hobbies',
        'skills',
        'city_residence',
        'years_in_city',
        'burning_desire',
        'key_success',
        'gains_profile',
        'ambitions',
        'achievements',
        'tops_profile',
        'ideal_referrals',
        'best_product',
        'networking_groups',
        'profile_image',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sentConnections()
    {
        return $this->hasMany(Connection::class, 'sender_id');
    }

    // Connections received by this user
    public function receivedConnections()
    {
        return $this->hasMany(Connection::class, 'receiver_id');
    }

    // Approved connections for this user
    public function connections()
    {
        return $this->belongsToMany(
            User::class,
            'connections',
            'sender_id',
            'receiver_id'
        )->wherePivot('status', 'approved')
         ->withTimestamps();
    }
    public function posts()
        {
            return $this->hasMany(Post::class, 'user_id', 'id');
        }
    public function referrals()
    {
        return $this->hasMany(
            Referrals::class,
            'user_id','id'
        );
    }
    public function referralslist()
    {
        return $this->hasMany(
            Referrals::class,
            'user_id','id'
        )->with('user')->with('received');
    }
    
    public function tyfcbreferralslist()
    {
        return $this->hasMany(
            Tyfcbreferrals::class,
            'user_id','id'
        )->with('user')->with('received');
        

    }
   
    public function receivedReferralslist()
    {
        return $this->hasMany(
            Referrals::class,
            'received_to','id'
        )->with('user')->with('received');
    }
    public function OneReferralslist()
    {
        return $this->hasMany(
            Onereferrals::class,
            'user_id','id'
        )->with('user')->with('received');
    }
    public function tyfcbreferralstotal()
    {
        return $this->hasMany(
            Tyfcbreferrals::class,
            'user_id','id'
        )->with('user')->with('received')
        ->select(DB::raw('SUM(amount) as subtotal'));
    }
    public function testmonialRelated()
    {
        return $this->belongsToMany(
            User::class,
            'testimonials', 
            'user_id',      
            'received_to'
        );
    }
    public function visitorlist(){
        return $this->hasMany(
            Visitor::class,
            'user_id','id'
        )->with('user');
    }
    public function postreact() {
        return $this->hasMany(Postreact::class, 'user_id', 'id');
    }
    public function receivedReferralslistdate($startdate,$enddate)
    {
        return $this->hasMany(
            Referrals::class,
            'received_to','id'
        )->with('user')->with('received')->whereBetween('created_at', [$startdate, $enddate]);
    }
    public function receivedReferralslistDateFilter($query,$comment)
    {
        return $query->where('comments', $comment);
    }
    public function individuals()
    {
        return $this->hasOne(Individuals::class, 'user_id', 'id');
    }
}
