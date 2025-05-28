<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Character extends Model
{
    protected $fillable = ['name', 'description', 'red_picture', 'blu_picture'];

    // Геттер для получения полного URL изображения
    public function getRedPictureUrlAttribute()
    {
        return $this->getImageUrl($this->red_picture);
    }

    public function getBluPictureUrlAttribute()
    {
        return $this->getImageUrl($this->blu_picture);
    }

    private function getImageUrl(?string $path): ?string
    {
        if (!$path) return null;

        return Storage::url($path);

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
