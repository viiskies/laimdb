<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'name', 'category_id', 'user_id', 'description', 'year', 'rating'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function actors() {
        return $this->belongsToMany(Actor::class);
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function images() {
        return $this->morphMany(Image::class, 'imagable');
    }
}
