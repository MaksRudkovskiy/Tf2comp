<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'text', 'type', 'user_id'];

    // app/Models/Article.php
    public function editor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
