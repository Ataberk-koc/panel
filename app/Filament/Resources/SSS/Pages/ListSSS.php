<?php

namespace App\Filament\Resources\SSS\Pages;

use App\Filament\Resources\SSS\SSSResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;

class ListSSS extends ListRecords
{
    use Translatable;
    protected static string $resource = SSSResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            CreateAction::make(),
        ];
    }
}
