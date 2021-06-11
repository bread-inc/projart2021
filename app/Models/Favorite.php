<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=['quiz_id', 'user_id'];

    /**
     * Returns the user who the favorite belongs.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);    
    }

    /**
     * Returns the quiz who the favorite belongs.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quiz() {
        return $this->belongsTo(Quiz::class);
    }
}
