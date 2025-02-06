<?php 
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    
    class Leadership_victory_program extends Model
    {
        use HasFactory, SoftDeletes;
    
        protected $fillable = [
            'company_name',
            'category',
            'avg_referrals',
            'avg_visitors',
            'business_given',
            'absenteeism',
            'events_attended',
            'testimonial',
            'late',
            'lvp_score',
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
    
