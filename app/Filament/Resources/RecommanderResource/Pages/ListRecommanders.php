<?php

namespace App\Filament\Resources\RecommanderResource\Pages;

use App\Filament\Resources\RecommanderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Recommander;
use App\Models\AnggotaDewan;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;
use Filament\Forms\Components\Select;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelWriter;
use Illuminate\Support\Facades\Storage;
use App\Exports\TemplateExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListRecommanders extends ListRecords
{
    protected static string $resource = RecommanderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->uniqueField('nama_recommander')
                ->fields([
                    ImportField::make('nama_recommander')
                        ->required()
                        ->label('Nama Recommander'),
                    Select::make('anggota_dewan_id')
                        ->label('Anggota Dewan')
                        ->options(AnggotaDewan::all()->pluck('nama_anggota_dewan', 'id'))
                        ->required(),
                ])
                ->handleRecordCreation(function(array $data) {
                    return Recommander::create([
                        'nama_recommander' => $data['nama_recommander'],
                        'anggota_dewan_id' => $data['anggota_dewan_id'],
                    ]);
                }),
            ExportAction::make()
                ->exports([
                    ExcelExport::make()
                        ->fromTable()
                        ->withFilename(fn ($resource) => 'Recommanders - ' . date('Y-m-d'))
                        ->withWriterType(ExcelWriter::XLSX)
                        ->except(['created_at', 'updated_at', 'deleted_at'])
                        ->withColumns([
                            Column::make('id')->heading('ID'),
                            Column::make('nama_recommander')->heading('Nama Recommander'),
                            Column::make('anggotaDewan.nama_anggota_dewan')->heading('Anggota Dewan'),
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
            ['nama_recommander' => '', 'anggota_dewan_id' => '']
        ];
        $headings = ['Nama Recommander', 'Anggota Dewan ID'];

        $filePath = 'templates/import_template.xlsx';
        Excel::store(new TemplateExport($templateData, $headings), $filePath, 'local', ExcelWriter::XLSX);

        return Storage::download($filePath);
    }
}
