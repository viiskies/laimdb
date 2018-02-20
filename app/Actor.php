<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = [
        'name', 'birthday', 'deathday', 'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function movies() {
        return $this->belongsToMany(Movie::class);
    }

    public function images() {
        return $this->morphMany(Image::class, 'imagable');
    }
}
