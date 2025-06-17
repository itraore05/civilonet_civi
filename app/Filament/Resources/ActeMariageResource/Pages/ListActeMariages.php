<?php

namespace App\Filament\Resources\ActeMariageResource\Pages;

use App\Filament\Resources\ActeMariageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActeMariages extends ListRecords
{
    protected static string $resource = ActeMariageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
