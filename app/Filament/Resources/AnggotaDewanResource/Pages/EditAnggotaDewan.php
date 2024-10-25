<?php

namespace App\Filament\Resources\AnggotaDewanResource\Pages;

use App\Filament\Resources\AnggotaDewanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnggotaDewan extends EditRecord
{
    protected static string $resource = AnggotaDewanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
