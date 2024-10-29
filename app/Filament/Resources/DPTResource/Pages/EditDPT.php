<?php

namespace App\Filament\Resources\DPTResource\Pages;

use App\Filament\Resources\DPTResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDPT extends EditRecord
{
    protected static string $resource = DPTResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
