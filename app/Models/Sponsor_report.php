<?php 
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    
    class Sponsor_report extends Model
    {
        use HasFactory, SoftDeletes;
    
        protected $fillable = [
            'sponsor_leader_name',
            'total_leaders_created',
            'new_leader_name',
            'alliance_name',
            'application_date',
            'start_date',
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
    
