<?php 
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    
    class Knowledge_partner_report extends Model
    {
        use HasFactory, SoftDeletes;
    
        protected $fillable = [
            'meeting_date',
            'knowledge_partner_name',
            'meeting_agenda',
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
    
