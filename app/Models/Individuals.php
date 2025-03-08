<?php 
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    
    class Individuals extends Model
    {
        use HasFactory, SoftDeletes;
    
        protected $fillable = [
            'individualname',
            'individualbusiness',
            'individualachievement',
            'individualreferrals',
            'individualreferralsqty',
            'individualreferralsmrs',
            'individualreferralsmrsqty',
            'individualdirect',
            'individualdirectmrs',
            'individualbusinesstotal',
            'individualgbrmrs',
            'individualgbramount',
            'individualvisitors',
            'individualtestimonialmrs',
            'individualgivetoday',
            'status',
            'user_id'
        ];
    
        /**
         * Relationship with Category
         */
        public function user()
        {
            return $this->belongsTo(User::class);
        }
    }
    
