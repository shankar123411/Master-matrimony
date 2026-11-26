<?php

namespace App\Filament\Resources\Varans;

use App\Filament\Resources\Varans\Pages\CreateVaran;
use App\Filament\Resources\Varans\Pages\EditVaran;
use App\Filament\Resources\Varans\Pages\ListVarans;
use App\Filament\Resources\Varans\Schemas\VaranForm;
use App\Filament\Resources\Varans\Tables\VaransTable;
use App\Models\Varan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VaranResource extends Resource
{
    protected static ?string $model = Varan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHeart;

    protected static ?string $navigationLabel = 'மணமாலை வரன்கள் (Matrimony)';

    protected static ?string $modelLabel = 'வரன் (Profile)';

    protected static ?string $pluralModelLabel = 'மணமாலை வரன்கள் (Profiles)';

    public static function form(Schema $schema): Schema
    {
        return VaranForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VaransTable::configure($table);
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
            'index' => ListVarans::route('/'),
            'create' => CreateVaran::route('/create'),
            'edit' => EditVaran::route('/{record}/edit'),
        ];
    }
}
