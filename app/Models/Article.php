<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'text', 'type'];

    public function comment()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
