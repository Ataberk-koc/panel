<?php

namespace App\Filament\Resources\SSS\Pages;

use App\Filament\Resources\SSS\SSSResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;

class CreateSSS extends CreateRecord
{
    use Translatable;
    protected static string $resource = SSSResource::class;
    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            // ...
        ];
    }
}
