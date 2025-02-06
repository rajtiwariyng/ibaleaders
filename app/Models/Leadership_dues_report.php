<?php 
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    
    class Leadership_dues_report extends Model
    {
        use HasFactory, SoftDeletes;
    
        protected $fillable = [
            'leader_name',
            'category',
            'role',
            'membership_status',
            'renewal_date',
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
    
