<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clue extends Model
{
    use HasFactory;

    protected $fillable=['id_question','description','radius'];

    public function question() {
        return $this->belongsTo(Question::class);    
    }
}
