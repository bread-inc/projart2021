<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $fillable=['label', 'description', 'pictogram', 'color', 'type', 'criterium'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function badgeable()
    {
        return $this->morphTo();
    }
}
