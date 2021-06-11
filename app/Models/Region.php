<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=['name','center_x','center_y', 'image'];

    /**
     * Returns the Quizzes related to the Region.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quizzes() {
        return $this->hasMany(Quiz::class);
    }

    /**
     * Returns the Badges morphed to the Region.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function badges() {
        return $this->morphMany(Badge::class, 'badgeable');
    }
}
