<?php

namespace App\Filament\Resources\SSS\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Forms\Components\Hidden;

class SSSForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('catalog.general'))
                    ->schema([
                        Textarea::make('question')
                            ->label(__('catalog.question'))
                            ->reactive()
                            ->translateLabel()
                            ->markAsrequired(false)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {

                                if (!$get('slug_touched')) {
                                    $set('slug', Str::slug($state));
                                }
                            }),


                        Textarea::make('answer')
                            ->label(__('catalog.answer'))
                            ->translateLabel()
                        ,

                        FileUpload::make('description')
                            ->label(__('catalog.image'))
                            ->markAsrequired(false)
                            ->translateLabel(),

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

                    ]),

                Section::make('SEO')
                    ->schema([
                        TextInput::make('slug')
                            ->label(__('catalog.slug'))
                            ->unique(ignoreRecord: true)
                            ->markAsrequired(false)
                            ->afterStateUpdated(function ($state, callable $set) {
                                // Artık otomatik güncellenmesin
                                $set('slug_touched', true);
                            }),

                        Hidden::make('slug_touched')->default(false),


                        TextArea::make('meta_title')
                            ->label(__('catalog.meta_title'))
                            ->helperText(__('catalog.meta_title_helper'))
                            ->markAsrequired(false),

                        TextArea::make('meta_description')
                            ->label(__('catalog.meta_description'))
                            ->helperText(__('catalog.meta_description_helper'))
                            ->markAsrequired(false),

                        TagsInput::make('meta_keywords')
                            ->helperText(__('catalog.meta_keywords_helper'))
                            ->label(__('catalog.meta_keywords'))
                    ]),
            ]);
    }
}
