<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory,HasTranslations;
    protected $fillable = [
        'title',
        'content',
        'slug',
        'description',
        'user_id',
        'banner',
        'gallery_images',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'published_at',
        'publish_status',
        'view_count',
        'reading_time',
        'status',
    ];
    public $translatable = [
        'title',
        'slug',
        'description',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'summary',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'status' => 'boolean',
        'sort_order' => 'integer',
        'view_count' => 'integer',
        'reading_time' => 'integer',
        'published_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($post) {
            if (empty($post->sort_order)) {
                $post->sort_order = (static::max('sort_order') ?? 0) + 1;
            }
            if (empty($post->user_id)) {
                $post->user_id = auth()->id();
            }
        });
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post', 'post_id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function sliders()
    {
        return $this->belongsToMany(Slider::class, 'post_slider');
    }

    public function sss()
    {
        return $this->belongsToMany(SSS::class, 'post_sss', 'post_id', 's_s_s_id')
            ->withPivot('sort_order')
            ->where('status', true)
            ->orderBy('post_sss.sort_order');
    }
    public function galleries()
    {
        // Eğer Galeri ile Post arasında Çoka-Çok ilişki varsa (Bir postta birden fazla galeri olabilir):
        return $this->belongsToMany(Gallery::class, 'post_gallery');
    }
}

