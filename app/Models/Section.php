<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $fillable = ['title', 'schema', 'status', 'sort_order'];

    protected $casts = [
        'schema' => 'array',
        'status' => 'boolean',
    ];

    protected $translatable = [
        'title',
        'schema',
    ];
}
