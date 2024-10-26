<?php

namespace App\Filament\Resources\OperatorResource\Pages;

use App\Filament\Resources\OperatorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use Maatwebsite\Excel\Excel as ExcelWriter;

class ListOperators extends ListRecords
{
    protected static string $resource = OperatorResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExportAction::make()
                ->exports([
                    ExcelExport::make()
                        ->fromTable()
                        ->withFilename(fn ($resource) => 'Operators - ' . date('Y-m-d'))
                        ->withWriterType(ExcelWriter::XLSX)
                        ->except(['created_at', 'updated_at', 'deleted_at'])
                        ->withColumns([
                            Column::make('id')->heading('ID'),
                            Column::make('nama_operator')->heading('Nama Operator'),
                            Column::make('email')->heading('Email'),
                            Column::make('phone')->heading('Phone'),
                        ])
                ]),
        ];
    }
}
