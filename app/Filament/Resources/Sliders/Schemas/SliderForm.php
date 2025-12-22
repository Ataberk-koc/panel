<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Schemas\Schema;
use App\Models\Category;
use App\Models\Page;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->columns(12)
                ->schema([
                    Section::make(__('catalog.images'))
                        ->schema([
							FileUpload::make('desktop_image')
								->label(__('catalog.desktop_image'))
								->image()
								->disk('public')
								->directory('sliders/desktop')
								->visibility('public')
								->maxSize(10240) // 10MB
								->helperText(__('catalog.sliderdesk_helper')),

							FileUpload::make('mobile_image')
								->label(__('catalog.mobile_image'))
								->image()
								->disk('public')
								->directory('sliders/mobile')
								->visibility('public')
								->maxSize(10240) // 10MB
								->helperText(__('catalog.slidermobil_helper')),
                        ])
                        ->columnSpan(6)
                        ->collapsible()
                        ->collapsed(false),


                    Section::make(__('catalog.general'))
                        ->schema([
                            Select::make('link_type')
                                ->label(__('catalog.options'))
                                ->options([
                                    'page' => __('catalog.page'),
                                    'post' => __('catalog.posts'),
                                    'category' => __('catalog.category'),
                                    'tag' => __('catalog.tags'),
                                    'custom' => __('catalog.private_link'),
                                ])
                                ->reactive()
                                ->columnSpanFull(),

                            Select::make('page_id')
                                ->label(__('catalog.choose_page'))
                                ->options(Page::pluck('title', 'id'))
                                ->searchable()
                                ->visible(fn ($get) => $get('link_type') === 'page')
                                ->columnSpanFull(),

                            Select::make('post_id')
                                ->label(__('catalog.choose_post'))
                                ->options(Post::pluck('title', 'id'))
                                ->searchable()
                                ->visible(fn ($get) => $get('link_type') === 'post')
                                ->columnSpanFull(),

                            Select::make('category_id')
                                ->label(__('catalog.choose_category'))
                                ->options(Category::pluck('title', 'id'))
                                ->searchable()
                                ->visible(fn ($get) => $get('link_type') === 'category')
                                ->columnSpanFull(),

                            Select::make('tag_id')
                                ->label(__('catalog.choose_tag'))
                                ->options(Tag::pluck('title', 'id'))
                                ->searchable()
                                ->visible(fn ($get) => $get('link_type') === 'tag')
                                ->columnSpanFull(),

                            TextInput::make('url')
                                ->label('Manuel URL')
                                ->visible(fn ($get) => $get('link_type') === 'custom')
                                ->columnSpanFull(),

                            TextInput::make('title')
                                ->label(__('catalog.title'))
                                ->columnSpanFull(),

                            Textarea::make('short_description')
                                ->label(__('catalog.short_description'))
                                ->columnSpanFull(),

                            TextInput::make('button_text')
                                ->label(__('catalog.button_text'))
                                ->columnSpanFull(),
                        ])
                        ->columnSpan(6)
                        ->collapsible()
                        ->collapsed(false)
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),
            Section::make(__('catalog.navigation_group_setting'))
                ->schema([
                    Select::make('slider_type')
                        ->label(__('catalog.choose_option'))
                        ->options([
                            'homepage' => __('catalog.homepage'),
                            'post' => __('catalog.innerpage'),
                        ])
                        ->reactive()
                        ->searchable()
                        ->columnSpanFull(),
                    TextInput::make('sort_order')
                        ->numeric()
                        ->label(__('catalog.sort_order'))
                        ->default(0)
                        ->minValue(0)
                        ->maxValue(100),

                    DateTimePicker::make('start_date')
                        ->label(__('catalog.start_date'))
                        ->helperText(__('catalog.startdate_helper')),

                    DateTimePicker::make('end_date')
                        ->label(__('catalog.end_date'))
                        ->helperText(__('catalog.enddate_helper')),

                    Toggle::make('is_active')
                        ->label(__('catalog.published'))
                        ->default(true),

                    Toggle::make('show_on_desktop')
                        ->label(__('catalog.show_on_desktop'))
                        ->default(true),

                    Toggle::make('show_on_mobile')
                        ->label(__('catalog.show_on_mobile'))
                        ->default(true),
                ])
                ->columns(3)
                ->collapsible()
                ->collapsed(false)
                ->columnSpanFull(),
        ]);
    }
}
