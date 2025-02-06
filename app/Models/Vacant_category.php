<?php 
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    
    class Vacant_category extends Model
    {
        use HasFactory, SoftDeletes;
    
        protected $fillable = [
            'category',
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
    
