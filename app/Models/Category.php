<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
class Category extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;
    protected $fillable = [
        'parent_id',
        'title',
        'slug',
        'description',
        'content',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'sort_order',
        'logo',
        'banner',
        'gallery_images',
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

    protected $casts = [
        'gallery_images' => 'array',
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];


    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post', 'category_id', 'post_id');
    }
}


