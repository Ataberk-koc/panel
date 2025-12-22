<?php

namespace App\Filament\Resources\Languages\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LanguageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dil Bilgileri')
                    ->schema([
                        TextInput::make('name')
                            ->label('Dil Adı')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Örn: Türkçe, English, Deutsch'),

                        TextInput::make('code')
                            ->label('Dil Kodu')
                            ->required()
                            ->maxLength(10)
                            ->unique(ignoreRecord: true)
                            ->placeholder('Örn: tr, en, de')
                            ->helperText('ISO 639-1 dil kodu (2 karakter) kullanılmalıdır'),

                        FileUpload::make('flag')
                            ->label('Bayrak')
                            ->image()
                            ->directory('flags')
                            ->maxSize(1024)
                            ->helperText('Dil için bayrak görseli yükleyin'),
                    ])
                    ->columns(2),

                Section::make('Ayarlar')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('Sıralama')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->helperText('Dillerin gösterim sırası'),

                        Checkbox::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->helperText('Dil sitede kullanılabilir olsun mu?'),

                        Checkbox::make('is_default')
                            ->label('Varsayılan Dil')
                            ->default(false)
                            ->helperText('Bu dil varsayılan dil olarak ayarlansın mı?'),
                    ])
                    ->columns(3),
            ]);
    }
}





