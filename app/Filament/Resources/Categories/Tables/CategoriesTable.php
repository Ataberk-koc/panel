<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\TrashedFilter;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('banner')
                    ->label(__('catalog.banner_image'))
                    ->width(100)
                    ->height(100)
                    ->disk('public')
                    ->url(fn ($record) => $record->banner ? asset('storage/' . $record->banner) : null),
                TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->label(__('catalog.title')),
                ToggleColumn::make('status')
                    ->label(__('catalog.status'))
                    ->sortable()
                    ->onIcon('heroicon-o-check-circle')
                    ->offIcon('heroicon-o-x-circle')
                    ->onColor('success')
                    ->offColor('danger'),
                TextColumn::make('sort_order')
                    ->sortable()
                    ->label(__('catalog.sort_order')),
                TextColumn::make('created_at')
                    ->label(__('catalog.created_at'))
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->label(__('catalog.deleted_at'))
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('catalog.updated_at'))
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                TrashedFilter::make(),
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
