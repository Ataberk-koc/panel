<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make(__('catalog.general'))
                ->schema([
                    Select::make('parent_id')
                        ->label(__('catalog.parent_category'))
                        ->options(Category::query()->pluck('title', 'id'))
                        ->searchable(),

                    TextInput::make('title')
                        ->label(__('catalog.title'))
                        ->reactive()
                        ->translateLabel()
                        ->required(false)
                        ->afterStateUpdated(function (callable $set, $state) {
                            $set('slug', Str::slug($state));
                        }),

                    RichEditor::make('content')
                        ->label(__('catalog.content'))
                        ->translateLabel()
                        ->markAsrequired(false),


                    RichEditor::make('description')
                        ->label(__('catalog.description')),


                    FileUpload::make('banner')
                        ->label(__('catalog.banner_image'))
                        ->disk('public')
                        ->directory('categories/banners')
                        ->helperText(__('catalog.banner_helper')),
                    FileUpload::make('logo')
                        ->label(__('catalog.small_photo'))
                        ->disk('public')
                        ->directory('categories/logos')
                        ->helperText(__('catalog.smallphoto_helper')),



                    TextInput::make('sort_order')
                        ->label(__('catalog.sort_order'))
                        ->numeric()
                        ->default(0)
                        ->minValue(0)
                        ->maxValue(100),

                    Toggle::make('status')
                        ->default(true)
                        ->label(__('catalog.status'))
                        ->onIcon('heroicon-o-check-circle')
                        ->offIcon('heroicon-o-x-circle')
                        ->onColor('warning')
                        ->offColor('gray'),

                ]),

            Section::make('SEO')
                ->schema([
                    TextInput::make('slug')
                        ->label(__('catalog.slug'))
                        ->unique(ignoreRecord: true) // Eşsiz slug değeri
                        ->required(false)
                        ->helperText(__('catalog.slug_helper')),
                    Textarea::make('meta_title')
                        ->label(__('catalog.meta_title'))
                        ->required(false)
                        ->helperText(__('catalog.meta_title_helper')),



                    Textarea::make('meta_description')
                        ->label(__('catalog.meta_description'))
                        ->required(false)
                        ->helperText(__('catalog.meta_description_helper')),

                    TagsInput::make('meta_keywords')
                        ->label(__('catalog.meta_keywords'))
                        ->placeholder(__('catalog.new_tag'))
                        ->helperText(__('catalog.meta_keywords_helper'))

                ]),
        ]);
    }
}
