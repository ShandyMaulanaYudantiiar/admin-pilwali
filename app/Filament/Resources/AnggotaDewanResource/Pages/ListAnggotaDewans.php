<?php

namespace App\Filament\Resources\AnggotaDewanResource\Pages;

use App\Filament\Resources\AnggotaDewanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnggotaDewans extends ListRecords
{
    protected static string $resource = AnggotaDewanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
