<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;



class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label(__('catalog.form_title'))
                    ->markAsRequired()
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->label(__('catalog.description'))
                    ->rows(3)
                    ->columnSpanFull(),

                Repeater::make('schema')
                    ->label(__('catalog.areas'))
                    ->schema([

                        Select::make('type')
                            ->label('Tür')
                            ->options([
                                'text' => 'Text',
                                'email' => 'Email',
                                'number' => 'Number',
                                'textarea' => 'Textarea',
                                'select' => 'Select',
                                'checkbox' => 'Checkbox',
                                'radio' => 'Radio',
                            ])
                            ->markAsRequired()
                            ->reactive(),

                        TextInput::make('label')
                            ->label(__('catalog.name'))
                            ->markAsRequired(),

                        TextInput::make('placeholder')
                            ->label('Placeholder')
                            ->visible(fn ($get) => in_array($get('type'), [
                                'text', 'email', 'number', 'textarea'
                            ])),

                        TagsInput::make('options')
                            ->label(__('catalog.optionss'))
                            ->placeholder('Her bir seçeneği ayrı girin')
                            ->visible(fn ($get) => in_array($get('type'), [
                                'select', 'checkbox', 'radio'
                            ])),

                        Toggle::make('required')
                            ->label(__('catalog.is_required'))
                    ])
                    ->orderable('sort_order')
                    ->columnSpanFull(),

                Toggle::make('status')
                    ->label(__('catalog.status'))
                    ->default(true),

                TextInput::make('sort_order')
                    ->label(__('catalog.sort_order'))
                    ->numeric()
                    ->default(0),
            ]);
    }
}
