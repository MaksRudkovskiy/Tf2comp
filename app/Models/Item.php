<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    protected $fillable = [
        'name',
        'caption',
        'description',
        'upside',
        'downside',
        'image_path',
        'has_upside',
        'has_downside',
        'modes_id'
    ];

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(
            Character::class,
            'character_items',
            'items_id',
            'characters_id'
        );
    }

    public function mode()
    {
        return $this->belongsTo(Article::class, 'modes_id');
    }

    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('storage/'.$this->image_path) : null;
    }
}
