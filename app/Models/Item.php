<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    protected $fillable = [
        'name',
        'description',
        'upside',
        'downside',
        'image_path',
        'modes_id'
    ];

    // Исправляем название метода на characters (множественное число)
    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(
            Character::class,
            'character_items',  // имя промежуточной таблицы
            'items_id',         // внешний ключ для текущей модели
            'characters_id'     // внешний ключ для связанной модели
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
