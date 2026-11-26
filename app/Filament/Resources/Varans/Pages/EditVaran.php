<?php

namespace App\Filament\Resources\Varans\Pages;

use App\Filament\Resources\Varans\VaranResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVaran extends EditRecord
{
    protected static string $resource = VaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('printBiodata')
                ->label('🖨️ மஞ்சள் அட்டை பிரிண்ட் (Print Bio-data)')
                ->url(fn () => route('varans.print', $this->record))
                ->openUrlInNewTab()
                ->color('warning'),
            DeleteAction::make(),
        ];
    }
}
