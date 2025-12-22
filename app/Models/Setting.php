<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'site_name',
        'site_white_logo',
        'site_dark_logo',
        'favicon',
        'address',
        'working_hours',
        'phone',
        'country',
        'city',
        'postal_code',
        'latitude',
        'longitude',
        'google_embeded_url',
        'footer_icon',
        'email',
        'social_media',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public $translatable = [
        'site_name',
        'working_hours',
        'address',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'country',
        'city',

    ];

    protected $casts = [
        'social_media' => 'array',
        'phone' => 'array',
        'email' => 'array',
    ];
}

