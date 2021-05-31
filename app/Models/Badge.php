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

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function badgeable()
    {
        return $this->morphTo();
    }
}
