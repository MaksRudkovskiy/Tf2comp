<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = ['name', 'description', 'red_picture', 'blu_picture'];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'class_items', 'class_id', 'items_id');
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
