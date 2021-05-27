<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable=['id_quiz','picture','coord_x', 'coord_y', 'radius', 'description'];

    public function quiz() {
        return $this->belongsTo(Quiz::class);    
    }

    public function clues() {
        return $this->hasMany(Clue::class);
    }
}