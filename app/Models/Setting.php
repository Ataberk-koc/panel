<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    use HasFactory, HasTranslations;
    protected $appends = ['site_white_logo_url', 'site_dark_logo_url'];

    // Beyaz Logo için Tam URL üreten fonksiyon
    public function getSiteWhiteLogoUrlAttribute()
    {
        return $this->site_white_logo 
            ? Storage::disk('public')->url($this->site_white_logo) 
            : null;
    }

    // Siyah Logo için Tam URL üreten fonksiyon
    public function getSiteDarkLogoUrlAttribute()
    {
        return $this->site_dark_logo 
            ? Storage::disk('public')->url($this->site_dark_logo) 
            : null;
    }

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
        'full_address',
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
        'slogan',
        'full_address',

    ];

    protected $casts = [
        'social_media' => 'array',
        'phone' => 'array',
        'email' => 'array',
    ];
}

