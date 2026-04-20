<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

#[ObservedBy(PostObserver::class)]
class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'is_published', 'published_at', 'image_path', 'excerpt', 'user_id', 'category_id'];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];
/*
    protected function tittle(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
        );
    } */

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image_path ? Storage::url($this->image_path) : 'https://t3.ftcdn.net/jpg/10/22/24/80/360_F_1022248039_7LDxHRi3Mlt9BK3wzLBUGZp9XAO1gt2s.jpg',
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
