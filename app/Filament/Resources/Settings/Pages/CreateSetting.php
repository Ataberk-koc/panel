<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;


class CreateSetting extends CreateRecord
{
    use Translatable;
    protected static string $resource = SettingResource::class;
    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),

        ];
    }
}
