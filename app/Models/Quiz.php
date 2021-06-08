<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=['region_id', 'user_id','title','description','difficulty'];

    public function region() {
        return $this->belongsTo(Region::class);    
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function scores() {
        return $this->hasMany(Score::class);
    }

    public function badges() {
        return $this->morphMany(Badge::class, 'badgeable');
    }

    public function favorites() {
        return $this->hasMany(Favorites::class);
    }
}
