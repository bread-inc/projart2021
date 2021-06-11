<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pseudo',
        'email',
        'password',
        'avatar',
        'isAdmin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Returns the scores the user achieved.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scores() {
        return $this->hasMany(Score::class);    
    }

    
    /**
     * Returns the quizzes the user created.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    /**
     * Returns all the badges a user has.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function badges()
    {
        return $this->belongsToMany(Badge::class)->withTimestamps();;
    }

    /**
     * Returns all the favorite quizzes a user has.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorites() {
        return $this->hasMany(Favorite::class);
    }
}
