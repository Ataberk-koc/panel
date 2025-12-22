<?php

namespace App\Filament\Resources\Tags\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TagForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([Section::make(__('catalog.general'))
                ->schema([
                    TextInput::make('title')
                        ->label(__('catalog.tags'))
                        ->markAsrequired(false),
                    MarkdownEditor::make('content')
                        ->label(__('catalog.content'))
                        ->markAsrequired(false),
                    Section::make('Açıklama')
                        ->label(__('catalog.description'))

                        ->schema([
                            TextInput::make('description')
                                ->label(__('catalog.description'))
                        ])
                        ->collapsed(),

                    FileUpload::make('banner')
                        ->label(__('catalog.banner_image'))
                    ,
                    FileUpload::make('logo')
                        ->label(__('catalog.logo'))
                        ->placeholder(__('catalog.upload_logo'))
                        ->avatar(),
                    TextInput::make('sort_order')
                        ->numeric()
                        ->label(__('catalog.sort_order'))
                        //->default(0)
                        ->minValue(0)
                        ->maxValue(100),
                    Toggle::make('status')
                        ->label(__('catalog.status'))
                        ->default(true)
                        ->onIcon('heroicon-o-check-circle')
                        ->offIcon('heroicon-o-x-circle')
                        ->onColor('warning')
                        ->markAsrequired(false)
                        ->offColor('gray')
                        ->extraAttributes([
                            'class' => 'bg-gray-700' // Koyu gri için Tailwind sınıfı
                        ]),
                ]),

                Section::make('SEO')
                    ->schema([
                        TextInput::make('slug')
                            ->label(__('catalog.seo_url'))
                            ->unique(ignoreRecord: true)
                            ->markAsrequired(false),

                        TextInput::make('meta_title')
                            ->label(__('catalog.meta_title'))

                            ->markAsrequired(false),

                        TextInput::make('meta_description')
                            ->label(__('catalog.meta_description'))
                            ->markAsrequired(false),

                        TagsInput::make('meta_keywords')
                            ->label(__('catalog.meta_keywords'))
                            ->placeholder(__('catalog.new_tag'))
                    ]),
            ]);
    }
}
