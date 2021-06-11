<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clue extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=['question_id','description','radius'];

    /**
     * Return the parent question of the clue.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question() {
        return $this->belongsTo(Question::class);    
    }
}
