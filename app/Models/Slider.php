<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Slider extends Model
{
    use  HasFactory, HasTranslations;
    protected $fillable = [
        'post_id',
        'category_id',
        'tag_id',
        'title',
        'short_description',
        'desktop_image',
        'mobile_image',
        'url',
        'button_text',
        'sort_order',
        'status',
        'slider_type',
        'is_active',
        'is_enabled',
        'show_on_desktop',
        'show_on_mobile',
        'start_date',
        'end_date',
    ];
    public $translatable = [
        'title',
        'short_description',
        'url',
        'button_text',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_enabled' => 'boolean',
        'show_on_desktop' => 'boolean',
        'show_on_mobile' => 'boolean',
        'status' => 'boolean',
        'sort_order' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',

    ];

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'page_slider')
            ->withTimestamps();
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_slider')
            ->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
