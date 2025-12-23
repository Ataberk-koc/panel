<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Gallery extends Model
{
    use  SoftDeletes,HasFactory, HasTranslations;
    protected $table = 'galleries';

    protected $fillable = [
        'gallery_title',
        'slug',
        'gallery_photo',
        'status',
        'sort_order',
        'title',
        'description',
    ];
    public $translatable = [
        'gallery_title',
        'slug',
        'title',
        'description',
    ];

    protected $casts = [

        'status' => 'boolean',
        'sort_order' => 'integer',
        'gallery_photo' => 'array',
    ];
}
