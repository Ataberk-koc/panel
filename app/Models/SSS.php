<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class SSS extends Model
{
    use  SoftDeletes,HasFactory, HasTranslations;
    protected $table = 's_s_s';

    protected $fillable = [
        'question',
        'answer',
        'status',
        'sort_order',
        'description',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $translatable = [
        'question',
        'answer',
        'description',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}
