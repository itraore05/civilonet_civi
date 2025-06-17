<?php

namespace App\Filament\Resources\ActeDecesResource\Pages;

use App\Filament\Resources\ActeDecesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditActeDeces extends EditRecord
{
    protected static string $resource = ActeDecesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
