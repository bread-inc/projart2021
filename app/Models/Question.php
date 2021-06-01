<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=['quiz_id','picture','coord_x', 'coord_y', 'radius', 'description'];

    public function quiz() {
        return $this->belongsTo(Quiz::class);    
    }

    public function clues() {
        return $this->hasMany(Clue::class);
    }
}