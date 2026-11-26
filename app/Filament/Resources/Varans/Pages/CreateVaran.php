<?php

namespace App\Filament\Resources\Varans\Pages;

use App\Filament\Resources\Varans\VaranResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVaran extends CreateRecord
{
    protected static string $resource = VaranResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
