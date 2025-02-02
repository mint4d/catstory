<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    public function cats()
    {
        return $this->hasMany('App\Cat');
    }

    public function favorite_posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function scopeAuthors($query)
    {
        return $query->where('role_id', 2);
    }
    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }
}
