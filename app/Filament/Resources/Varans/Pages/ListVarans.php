<?php

namespace App\Filament\Resources\Varans\Pages;

use App\Filament\Resources\Varans\VaranResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVarans extends ListRecords
{
    protected static string $resource = VaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('quickForm')
                ->label('🎙️ நேரடி பதிவு & வாய்ஸ் பார்ம் (Quick Voice Form)')
                ->url(url('/matrimony/register'))
                ->openUrlInNewTab()
                ->color('warning'),
            CreateAction::make()
                ->label('புதிய வரன் சேர்க்க (Add Varan)'),
        ];
    }
}
