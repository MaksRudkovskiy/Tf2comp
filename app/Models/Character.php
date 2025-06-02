<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Character extends Model
{
    protected $fillable = ['name', 'description', 'red_picture', 'blu_picture', 'user_id'];

    public function getRedPictureUrlAttribute()
    {
        return $this->getImageUrl($this->red_picture);
    }

    public function getBluPictureUrlAttribute()
    {
        return $this->getImageUrl($this->blu_picture);
    }

    public function getImageUrl($field)
    {
        return $this->$field ? asset("storage/{$this->$field}") : null;
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'character_items', 'characters_id', 'items_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getIconLetter()
    {
        return match($this->name) {
            'Скаут' => 'A',
            'Солдат' => 'B',
            'Пиро' => 'C',
            'Дэмо' => 'D',
            'Хэви' => 'E',
            'Инженер' => 'F',
            'Медик' => 'G',
            'Снайпер' => 'H',
            'Шпион' => 'I',
            default => substr($this->name, 0, 1)
        };
    }
}
