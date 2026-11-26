<?php

namespace App\Filament\Resources\Varans\Tables;

use App\Support\MatrimonyConstants;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class VaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_path')
                    ->label('புகைப்படம் (Photo)')
                    ->circular()
                    ->defaultImageUrl('https://ui-avatars.com/api/?name=Varan&background=ffd600&color=000'),

                TextColumn::make('name')
                    ->label('வரன் பெயர் (Name)')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('varan_type')
                    ->label('பிரிவு')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'aan' ? '🤵 ஆண் வரன்' : '👰 பெண் வரன்')
                    ->color(fn ($state) => $state === 'aan' ? 'info' : 'danger'),

                TextColumn::make('rasi')
                    ->label('ராசி')
                    ->badge()
                    ->color('warning')
                    ->searchable(),

                TextColumn::make('natchathiram')
                    ->label('நட்சத்திரம்')
                    ->searchable(),

                TextColumn::make('education')
                    ->label('படிப்பு')
                    ->limit(20)
                    ->searchable(),

                TextColumn::make('job_title')
                    ->label('வேலை')
                    ->limit(20)
                    ->searchable(),

                TextColumn::make('father_mobile')
                    ->label('அலைபேசி (Phone)')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('பதிவு தேதி')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('varan_type')
                    ->label('வரன் வகை')
                    ->options([
                        'penn' => 'பெண் வரன் (Bride)',
                        'aan' => 'ஆண் வரன் (Groom)',
                    ]),

                SelectFilter::make('rasi')
                    ->label('ராசி வடிகட்டி')
                    ->options(MatrimonyConstants::rasis()),

                SelectFilter::make('natchathiram')
                    ->label('நட்சத்திர வடிகட்டி')
                    ->options(MatrimonyConstants::natchathirams()),
            ])
            ->recordActions([
                Action::make('print')
                    ->label('🖨️ PDF பிரிண்ட்')
                    ->icon('heroicon-o-printer')
                    ->color('warning')
                    ->url(fn ($record) => route('varans.print', $record))
                    ->openUrlInNewTab(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
