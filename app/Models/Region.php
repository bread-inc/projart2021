<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable=['name','center_x','center_y'];

    public function quizzes() {
        return $this->hasMany(Quiz::class);
    }

    public function badges() {
        return $this->morphMany(Badge::class, 'badgeable');
    }
}
