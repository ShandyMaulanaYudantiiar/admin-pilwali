<?php

namespace App\Filament\Resources\AnggotaDewanResource\Pages;

use Konnco\FilamentImport\Actions\ImportField;
use Konnco\FilamentImport\Actions\ImportAction;

use App\Models\AnggotaDewan as Item;
use App\Filament\Resources\AnggotaDewanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ListAnggotaDewans extends ListRecords
{
    protected static string $resource = AnggotaDewanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->uniqueField('nama_anggota_dewan')
                ->fields([
                    ImportField::make('nama_anggota_dewan')
                        ->required()
                    ->label('Nama Anggota Dewan'),
                ])
                ->handleRecordCreation(function(array $data) {
                    return Item::create([
                            'nama_anggota_dewan' => $data['nama_anggota_dewan'],
                        ]);

                    return new Item();
                }),
            ExportAction::make()
                ->exports([
                    ExcelExport::make()
                        ->fromTable()
                        ->withFilename(fn ($resource) =>  'Anggota Dewan - ' . date('Y-m-d'))
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                    ->except(['created_at', 'updated_at', 'deleted_at'])
                    ->withColumns([
                        Column::make('nama_anggota_dewan')->heading('Nama Anggota Dewan'),
                        Column::make('id')->heading('Anggota Dewan ID'),
                        ])
                ]),
        ];
    }
}
