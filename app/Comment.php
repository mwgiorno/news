<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'news_id', 'parent_id', 'body'
    ];

    public static function new($user, $news, $body)
    {
        return static::create([
            'user_id' => $user,
            'news_id' => $news,
            'body' => $body
        ]);
    }

    public static function reply($user, $news, $comment, $body)
    {
        return static::create([
            'user_id' => $user,
            'news_id' => $news,
            'parent_id' => $comment,
            'body' => $body
        ]);
    }

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
