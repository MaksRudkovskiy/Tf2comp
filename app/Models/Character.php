<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = ['name', 'description'];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'class_items', 'class_id', 'items_id');
    }
}
