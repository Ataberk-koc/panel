<?php

namespace App\Filament\Resources\SSS;

use App\Filament\Resources\SSS\Pages\CreateSSS;
use App\Filament\Resources\SSS\Pages\EditSSS;
use App\Filament\Resources\SSS\Pages\ListSSS;
use App\Filament\Resources\SSS\Schemas\SSSForm;
use App\Filament\Resources\SSS\Tables\SSSTable;
use App\Models\SSS;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;

class SSSResource extends Resource
{
    use Translatable;
    protected static ?string $model = SSS::class;
    public static function getNavigationGroup(): string
    {
        return __('catalog.navigation_group_catalog');
    }
    public static function getNavigationLabel(): string
    {
        return __('catalog.questions');
    }
    public static function getModelLabel(): string
    {
        return __('catalog.question');
    }
    public static function getNavigationSort(): int
    {
        return 7;
    }
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQuestionMarkCircle;

    public static function form(Schema $schema): Schema
    {
        return SSSForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SSSTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSSS::route('/'),
            'create' => CreateSSS::route('/create'),
            'edit' => EditSSS::route('/{record}/edit'),
        ];
    }
}
