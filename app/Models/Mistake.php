<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mistake extends Model
{
    protected $fillable = ['text', 'date', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
