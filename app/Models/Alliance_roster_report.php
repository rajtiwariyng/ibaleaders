<?php 
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    
    class Alliance_roster_report extends Model
    {
        use HasFactory, SoftDeletes;
    
        protected $fillable = [
            'leader_name',
            'category',
            'company_name',
            'lvp_score',
            'rg',
            'rr',
            'v',
            'gbr',
            'bg',
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
    
