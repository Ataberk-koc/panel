<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'tags';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'status',
        'sort_order',
        'meta_description',
        'meta_keywords',
    ];

    public $translatable = [
        'title',
        'slug',
        'description',
        'content',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($tag) {
            if (empty($tag->sort_order)) {
                $tag->sort_order = (static::max('sort_order') ?? 0) + 1;
            }
        });
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id');
    }
}


