<?php

namespace App\Filament\Resources\RecommanderResource\Pages;

use App\Filament\Resources\RecommanderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRecommanders extends ListRecords
{
    protected static string $resource = RecommanderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
