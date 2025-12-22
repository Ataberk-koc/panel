<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->onDelete('cascade');
            $table->string('site_name');
            $table->string('slogan')->nullable();
            $table->string('site_white_logo')->nullable();
            $table->string('site_dark_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('footer_icon')->nullable();
            $table->boolean('maintenance_mode')->default(false);
            $table->boolean('is_online_reservation')->default(true);
            $table->integer('google_analytics_id')->nullable();
            $table->integer('google_tagmanager_id')->nullable();
            $table->integer('fbpixel_id')->nullable();
            $table->integer('meta_ads_id')->nullable();
            $table->integer('yandex_verification_id')->nullable();
            $table->integer('hotjar_id')->nullable();
            $table->string('reservation_mail')->nullable();
            $table->string('reservation_phone')->nullable();
            $table->json('meta_title');
            $table->json('meta_description');
            $table->json('meta_keywords')->nullable();
            $table->json('phone')->nullable();
            $table->json('email')->nullable();
            $table->json('social_media')->nullable();
            $table->text('address')->nullable();
            $table->json('country')->nullable();
            $table->json('city')->nullable();
            $table->string('google_embeded_url')->nullable();
            $table->integer('latitude')->nullable();
            $table->integer('longitude')->nullable();
            $table->integer('postal_code')->nullable();
            $table->json('working_hours')->nullable();
            $table->json('head_code')->nullable();
            $table->json('footer_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
