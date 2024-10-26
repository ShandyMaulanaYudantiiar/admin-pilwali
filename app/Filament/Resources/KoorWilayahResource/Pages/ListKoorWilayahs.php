<?php

namespace App\Filament\Resources\KoorWilayahResource\Pages;

use App\Exports\TemplateExport;
use App\Filament\Resources\KoorWilayahResource;
use App\Models\Kecamatan;
use App\Models\KoorWilayah;
use Filament\Forms\Components\Select;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;
use Maatwebsite\Excel\Excel as ExcelWriter;
use Maatwebsite\Excel\Facades\Excel;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListKoorWilayahs extends ListRecords
{
    protected static string $resource = KoorWilayahResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->uniqueField('nama_koor_wilayah')
                ->fields([
                    ImportField::make('nama_koor_wilayah')
                        ->required()
                        ->label('Nama Koor Wilayah'),
                    Select::make('kecamatan_id')
                        ->label('Kecamatan')
                        ->options(Kecamatan::all()->pluck('nama_kecamatan', 'id'))
                        ->required(),
                ])
                ->handleRecordCreation(function(array $data) {
                    return KoorWilayah::create([
                        'nama_koor_wilayah' => $data['nama_koor_wilayah'],
                        'kecamatan_id' => $data['kecamatan_id'],
                    ]);
                }),
            ExportAction::make()
                ->exports([
                    ExcelExport::make()
                        ->fromTable()
                        ->withFilename(fn ($resource) => 'KoorWilayahs - ' . date('Y-m-d'))
                        ->withWriterType(ExcelWriter::XLSX)
                        ->except(['created_at', 'updated_at', 'deleted_at'])
                        ->withColumns([
                            Column::make('id')->heading('ID'),
                            Column::make('nama_koor_wilayah')->heading('Nama Koor Wilayah'),
                            Column::make('kecamatan.nama_kecamatan')->heading('Kecamatan'),
                        ])
                ]),
            Actions\Action::make('downloadTemplate')
                ->label('Download Import Template')
                ->action('downloadTemplate')
        ];
    }

    public function downloadTemplate()
    {
        $templateData = [
            ['nama_koor_wilayah' => '', 'kecamatan_id' => '']
        ];
        $headings = ['Nama Koor Wilayah', 'Kecamatan ID'];

        $filePath = 'templates/import_template_koor_wilayah.xlsx';
        Excel::store(new TemplateExport($templateData, $headings), $filePath, 'local', ExcelWriter::XLSX);

        return Storage::download($filePath);
    }
}
