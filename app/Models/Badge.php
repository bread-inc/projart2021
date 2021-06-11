<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    public $timestamps = false;

    const PICTO_1 = "fa-thumbs-up";
    const PICTO_2 = "fa-trophy";
    const PICTO_3 = "fa-globe-europe";
    const PICTO_4 = "fa-search-location";
    const PICTOGRAMS = [Badge::PICTO_1, Badge::PICTO_2, Badge::PICTO_3, Badge::PICTO_4];

    protected $fillable=['label', 'description', 'pictogram', 'color', 'type', 'criterium', 'badgeable_id', 'badgeable_type'];

    /**
     * Returns the relation between a badge and the users who got the badge.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();;
    }

    /**
     * Can be morphed to a Region or a Quiz.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function badgeable()
    {
        return $this->morphTo();
    }
}
