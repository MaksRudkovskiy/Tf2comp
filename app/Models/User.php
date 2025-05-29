<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAvatarAttribute($value)
    {
        if ($value === null) {
            return null;
        }

        return $value;
    }

    public function mistakes()
    {
        return $this->hasMany(Mistake::class);
    }

    public function setAvatarAttribute($value)
    {
        if ($value === null || is_string($value)) {
            $this->attributes['avatar'] = $value;
        } else {
            $this->attributes['avatar'] = file_get_contents($value->getRealPath());
        }
    }

    // app/Models/User.php
    public function isAdmin(): bool
    {
        return $this->role === 1;
    }
}
