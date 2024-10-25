<?php

namespace App\Filament\Resources\KoorWilayahResource\Pages;

use App\Filament\Resources\KoorWilayahResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKoorWilayah extends EditRecord
{
    protected static string $resource = KoorWilayahResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
