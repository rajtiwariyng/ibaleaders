<?php 
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    
    class Visitor_report extends Model
    {
        use HasFactory, SoftDeletes;
    
        protected $fillable = [
            'visitor_name',
            'company_name',
            'category',
            'visit_date',
            'invited_by',
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
    
