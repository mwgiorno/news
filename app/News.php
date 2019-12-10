<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class News extends Model
{
    use \Conner\Tagging\Taggable;

    protected $dates = [
        'updated_at', 'created_at'
    ];
    protected $fillable = [
        'user_id', 'title', 'content', 'description', 'image_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public function getUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->toFormattedDateString();
    }

    public function getUpdatedDate()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}
