<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'name', 'category_id', 'user_id', 
        'description', 'year', 'rating'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
