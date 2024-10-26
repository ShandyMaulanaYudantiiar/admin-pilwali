<?php

namespace App\Filament\Resources\OrganisasiResource\Pages;

use App\Filament\Resources\OrganisasiResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Excel as ExcelWriter;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListOrganisasis extends ListRecords
{
    protected static string $resource = OrganisasiResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExportAction::make()
                ->exports([
                    ExcelExport::make()
                        ->fromTable()
                        ->withFilename(fn ($resource) => 'Organisasis - ' . date('Y-m-d'))
                        ->withWriterType(ExcelWriter::XLSX)
                        ->except(['created_at', 'updated_at', 'deleted_at'])
                        ->withColumns([
                            Column::make('id')->heading('ID'),
                            Column::make('nama_organisasi')->heading('Nama Organisasi'),
                        ])
                ]),
        ];
    }
}
