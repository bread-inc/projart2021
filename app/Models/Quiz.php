<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=['region_id', 'user_id','title','description','difficulty'];

    /**
     * Returns the Region the Quiz is related to.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region() {
        return $this->belongsTo(Region::class);    
    }

    /**
     * Returns the User the Quiz is related to.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns the Questions related to the Quiz.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions() {
        return $this->hasMany(Question::class);
    }

    /**
     * Returns the Scores related to the Quiz.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scores() {
        return $this->hasMany(Score::class);
    }

    /**
     * Returns the Badges morphed to the Quiz.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function badges() {
        return $this->morphMany(Badge::class, 'badgeable');
    }

    /**
     * Returns the Favorites related to the Quiz.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorites() {
        return $this->hasMany(Favorites::class);
    }
}
