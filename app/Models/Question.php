<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=['quiz_id','picture','coord_x', 'coord_y', 'radius', 'description'];

    /**
     * Returns the Quiz the Question is related to.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quiz() {
        return $this->belongsTo(Quiz::class);    
    }

    /**
     * Returns the Clues related to the Question.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clues() {
        return $this->hasMany(Clue::class);
    }
}