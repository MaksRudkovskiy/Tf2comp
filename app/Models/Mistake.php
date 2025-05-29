<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mistake extends Model
{
    protected $fillable = ['text', 'date', 'status', 'user_id'];

    protected $dates = ['date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
