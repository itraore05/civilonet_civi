<?php

namespace App\Filament\Resources\ActeDecesResource\Pages;

use App\Filament\Resources\ActeDecesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActeDeces extends ListRecords
{
    protected static string $resource = ActeDecesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
