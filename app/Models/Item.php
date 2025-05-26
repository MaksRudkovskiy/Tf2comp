<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'description', 'upside', 'downside', 'modes_id'];

    public function mode()
    {
        return $this->belongsTo(Article::class, 'modes_id');
    }

    public function class()
    {
        return $this->belongsToMany(Character::class, 'class_items', 'items_id', 'class_id');
    }
}
