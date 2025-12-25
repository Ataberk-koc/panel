<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                    \Filament\Forms\Components\Textarea::make('description')
                        ->rows(5)
                        ->columnSpanFull(),
                TextInput::make('content')
                    ->required(),
                    \Filament\Forms\Components\Select::make('gallery_images')
                        ->label(__('catalog.gallery'))
                        ->multiple()
                        ->relationship('galleries', 'gallery_title')
                        ->preload()
                        ->searchable()
                        ->required(false),
                    \Filament\Forms\Components\Select::make('categories')
                        ->label('Kategori')
                        ->multiple()
                        ->relationship('categories', 'title')
                        ->preload()
                        ->searchable()
                        ->required(false),
                Select::make('publish_status')
                    ->options([
            'draft' => 'Draft',
            'published' => 'Published',
            'scheduled' => 'Scheduled',
            'archived' => 'Archived',
        ])
                    ->default('draft')
                    ->required(),
                DateTimePicker::make('published_at'),
                TextInput::make('view_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('reading_time')
                    ->required()
                    ->numeric()
                    ->default(0),
                    \Filament\Forms\Components\FileUpload::make('banner')
                        ->directory('banners')
                        ->disk('public')
                        ->preserveFilenames(),
                TextInput::make('meta_title'),
                TextInput::make('meta_description'),
                TextInput::make('meta_keywords'),
                Toggle::make('status')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric(),
            ]);
    }
}
