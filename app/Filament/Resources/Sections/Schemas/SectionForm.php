<?php

namespace App\Filament\Resources\Sections\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Builder; // Builder bileşeni eklendi
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\Builder\Block;

class SectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label(__('catalog.content_title'))
                    ->markAsRequired()
                    ->placeholder( __('catalog.content_title_helper')),


                Builder::make('schema')
                    ->label(__('catalog.content_block'))

                    ->addActionLabel(__('catalog.add_block'))
                    ->blocks([
                        // 1. Başlık Bloğu
                        Block::make('heading')
                            ->label(__('catalog.title'))
                            ->schema([
                                TextInput::make('content')
                                    ->label(__('catalog.title_postfix'))
                                    ->markAsRequired(),
                                Select::make('level')
                                    ->options(['h1'=>'H1', 'h2'=>'H2', 'h3'=>'H3'])
                                    ->default('h2'),
                            ]),

                        // 2. Paragraf Bloğu
                        Block::make('paragraph')
                            ->label(__('catalog.paragraph'))
                            ->schema([
                                RichEditor::make('content')
                                    ->label(__('catalog.texti')),
                            ]),

                        // 3. Resim Bloğu
                        Block::make('image')
                            ->label(__('catalog.image'))
                            ->schema([
                                FileUpload::make('url')
                                    ->image()
                                    ->directory('sections'),
                            ]),

                        // İstersen Buton, Video vs. ekle...
                    ])
                    ->collapsible()
                    ->reorderable(),
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
            ])->columns(1);
    }
}
