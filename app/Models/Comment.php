<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['text', 'date', 'user_id', 'commentable_id', 'commentable_type'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($comment) {
            if (!in_array($comment->commentable_type, ['articles', 'sections'])) {
                throw new \Exception('commentable_type должен быть "articles" или "sections"');
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentable()
    {
        // Преобразуем имя таблицы в имя модели
        $model = match ($this->commentable_type) {
            'articles' => Article::class,
            'sections' => Section::class,
            default => throw new \Exception('Неподдерживаемый commentable_type'),
        };

        return $this->morphTo('commentable', $model, 'commentable_id', 'id');
    }
}
