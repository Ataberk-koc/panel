<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes,HasTranslations;
    protected $casts = [
        'page_sections'=> 'array',
        'gallery_images' => 'array',
        'status'=>'boolean',
        'sort_order'=>'integer',
        'published_at'=>'datetime',

    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'publish_status',
        'published_at',
        'page_sections',
        'status',
        'banner',
        'gallery_images',
        'meta_description',
        'meta_keywords',
        'sort_order'
    ];
    public $translatable = [
        'title',
        'slug',
        'description',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
    protected static function booted()
    {
        static::creating(function ($category) {

            if (empty($category->sort_order)) {
                $category->sort_order = (static::max('sort_order') ?? 0) + 1;
            }
        });
    }
    public function sliders() {
        return $this->belongsToMany(Slider::class, 'page_slider');
    }

    public function galleries() {
        return $this->belongsToMany(Gallery::class, 'page_gallery');
    }

    public function sss() {
        return $this->belongsToMany(SSS::class, 'page_s_s_s');
    }

}
