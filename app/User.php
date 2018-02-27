<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'fb_id'
    ];
    
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function categories() {
        return $this->hasMany( Category::class );
    }
    
    public function movies() {
        return $this->hasMany( Movie::class );
    }
    
    public function actors() {
        return $this->hasMany( Actor::class );
    }
    
    public function votes() {
        return $this->belongsToMany(Movie::class)->withPivot('vote')->withTimestamps();
    }
    
    /**
    * @param string|array $roles
    */
    public function authorizeRoles( $role )
    {
        return $this->isRegistered( $role ) || abort(401, 'This action is unauthorized.');
    }

    /**
    * Check role
    * @param string $role
    */
    public function isRegistered( $role )
    {
        if ($role === 'admin') {
            return $this->role === 'admin' ;
        } elseif ($role === 'user') {
            return $this->role === 'user' || $this->role === 'admin';
        } else {
            return false;
        }
    }
}
