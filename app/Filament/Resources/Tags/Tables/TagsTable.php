<?php

namespace App\Filament\Resources\Tags\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class TagsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('banner')  // 'image' sütun adı
                ->label(__('catalog.banner_image'))         // Resim için başlık
                ->width(100)             // Genişlik ayarları (opsiyonel)
                ->height(100),
                TextColumn::make('title')
                    ->label(__('catalog.title'))
                    ->sortable(),
                ToggleColumn::make('status')
                    ->label(__('catalog.status'))
                    ->sortable()
                    ->onColor('success')
                    ->offColor('danger'),
                TextColumn::make('sort_order')
                    ->sortable()
                    ->label(__('catalog.sort_order')),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
