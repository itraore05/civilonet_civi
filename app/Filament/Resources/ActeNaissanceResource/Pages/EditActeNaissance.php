<?php

namespace App\Filament\Resources\ActeNaissanceResource\Pages;

use App\Filament\Resources\ActeNaissanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditActeNaissance extends EditRecord
{
    protected static string $resource = ActeNaissanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
