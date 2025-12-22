<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('catalog.general'))
                    ->schema([
                        TextInput::make('gallery_title')
                            ->label(__('catalog.gallery'))
                            ->reactive()
                            ->translateLabel()
                            ->markAsrequired(false)
                            ->formatStateUsing(function ($state, $record, $component) {
                                // Eğer çok dilli ise aktif dili göster
                                if (is_array($state)) {
                                    $activeLocale = app()->getLocale();
                                    return $state[$activeLocale] ?? reset($state) ?? '';
                                }
                                return $state;
                            })
                            ->afterStateUpdated(function ($set, $state, $livewire) {
                                $activeLocale = $livewire->activeLocale ?? app()->getLocale();
                                if (is_array($state)) {
                                    $text = $state[$activeLocale] ?? '';
                                } else {
                                    $text = $state;
                                }
                                $set('slug', Str::slug($text));
                            }),

                        FileUpload::make('gallery_photo')
                            ->label(__('catalog.gallery_images'))
                            ->translateLabel()
                            ->helperText(__('catalog.gallery_images_helper'))
                        ,
                        TextInput::make('slug')
                            ->label('URL (Slug)')
                            ->required()
                            ->readOnly() // Kullanıcı değiştiremesin (İstersen kaldırabilirsin)
                            ->unique(ignoreRecord: true)
                            ->formatStateUsing(function ($state) {
                                // Eğer bir dizi gelirse stringe çevir
                                if (is_array($state)) {
                                    $activeLocale = app()->getLocale();
                                    return $state[$activeLocale] ?? reset($state) ?? '';
                                }
                                return $state;
                            }),

                        TextInput::make('sort_order')
                            ->numeric()
                            ->label(__('catalog.sort_order'))
                            ->default(0)
                            ->minValue(0)
                            ->maxValue(100),
                        Toggle::make('status')
                            ->label(__('catalog.status'))
                            ->onIcon('heroicon-o-check-circle')
                            ->offIcon('heroicon-o-x-circle')
                            ->default(true)
                            ->onColor('warning')
                            ->helperText(__('catalog.is_active'))
                            ->markAsrequired(false)
                            ->offColor('gray')
                            ->extraAttributes([
                                'class' => 'bg-gray-700' // Koyu gri için Tailwind sınıfı
                            ]),

                    ])
                    ->columnSpanFull(),


            ]);
    }
}
