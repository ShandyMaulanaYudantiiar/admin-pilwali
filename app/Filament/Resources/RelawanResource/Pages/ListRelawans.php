<?php

namespace App\Filament\Resources\RelawanResource\Pages;

use App\Filament\Resources\RelawanResource;
use App\Models\Relawan;
use App\Models\AnggotaDewan;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelWriter;
use Illuminate\Support\Facades\Storage;
use App\Exports\TemplateExport;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ListRelawans extends ListRecords
{
    protected static string $resource = RelawanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->uniqueField('nik')
                ->fields([
                    ImportField::make('nama_relawan')->required()->label('Nama Relawan'),
                    ImportField::make('nik')->required()->label('NIK'),
                    ImportField::make('tempat_lahir')->required()->label('Tempat Lahir'),
                    ImportField::make('tanggal_lahir')->required()->label('Tanggal Lahir'),
                    ImportField::make('alamat')->required()->label('Alamat'),
                    ImportField::make('rt')->required()->label('RT'),
                    ImportField::make('rw')->required()->label('RW'),
                    ImportField::make('no_hp')->required()->label('No HP'),
                    ImportField::make('id_kecamatan')->required()->label('Kecamatan'),
                    ImportField::make('koor_wilayah_id')->required()->label('Koor Wilayah'),
                    ImportField::make('jabatan_id')->required()->label('Jabatan'),
                    ImportField::make('operator_id')->required()->label('Operator'),
                    ImportField::make('anggota_dewan_id')->required()->label('Anggota Dewan'),
                    ImportField::make('recommander_id')->required()->label('Recommander'),
                    ImportField::make('tps')->required()->label('TPS'),
                    ImportField::make('organisasi_id')->required()->label('Organisasi'),
                    ImportField::make('sk')->required()->label('SK'),
                    ImportField::make('status_nik')->required()->label('Status NIK'),
                ])
                ->handleRecordCreation(function(array $data) {
                    if (is_numeric($data['tanggal_lahir'])) {
                        $date = Date::excelToDateTimeObject($data['tanggal_lahir']);
                        $data['tanggal_lahir'] = $date->format('Y-m-d');
                    } elseif (strtotime($data['tanggal_lahir']) !== false) {
                        $data['tanggal_lahir'] = date('Y-m-d', strtotime($data['tanggal_lahir']));
                    } else {
                        throw new \Exception('Invalid date format for tanggal_lahir');
                    }
                    return Relawan::create($data);
                }),
            ExportAction::make()
                ->exports([
                    ExcelExport::make()
                        ->fromTable()
                        ->withFilename(fn ($resource) => 'Relawans - ' . date('Y-m-d'))
                        ->withWriterType(ExcelWriter::XLSX)
                        ->except(['updated_at', 'deleted_at'])
                        ->withColumns([
                            Column::make('id')->heading('ID'),
                            Column::make('nama_relawan')->heading('Nama Relawan'),
                            Column::make('nik')->heading('NIK'),
                            Column::make('tempat_lahir')->heading('Tempat Lahir'),
                            Column::make('tanggal_lahir')->heading('Tanggal Lahir'),
                            Column::make('alamat')->heading('Alamat'),
                            Column::make('rt')->heading('RT'),
                            Column::make('rw')->heading('RW'),
                            Column::make('no_hp')->heading('No HP'),
                            Column::make('kecamatan.nama_kecamatan')->heading('Kecamatan'),
                            Column::make('koorWilayah.nama_koor_wilayah')->heading('Koor Wilayah'),
                            Column::make('jabatan.nama_jabatan')->heading('Jabatan'),
                            Column::make('operator.nama_operator')->heading('Operator'),
                            Column::make('anggotaDewan.nama_anggota_dewan')->heading('Anggota Dewan'),
                            Column::make('recommander.nama_recommander')->heading('Recommander'),
                            Column::make('tps')->heading('TPS'),
                            Column::make('organisasi.nama_organisasi')->heading('Organisasi'),
                            Column::make('sk')->heading('SK'),
                            Column::make('status_nik')->heading('Status NIK'),
                            Column::make('created_at')->heading('Tanggal Input'),
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
            ['nama_relawan' => '', 'nik' => '', 'tempat_lahir' => '', 'tanggal_lahir' => '', 'alamat' => '', 'rt' => '', 'rw' => '', 'no_hp' => '', 'id_kecamatan' => '', 'koor_wilayah_id' => '', 'jabatan_id' => '', 'operator_id' => '', 'anggota_dewan_id' => '', 'recommander_id' => '', 'tps' => '', 'organisasi_id' => '', 'sk' => '', 'status_nik' => '']
        ];
        $headings = ['Nama Relawan', 'NIK', 'Tempat Lahir', 'Tanggal Lahir', 'Alamat', 'RT', 'RW', 'No HP', 'Kecamatan', 'Koor Wilayah', 'Jabatan', 'Operator', 'Anggota Dewan', 'Recommander', 'TPS', 'Organisasi', 'SK', 'Status NIK'];

        $filePath = 'templates/import_template_relawans.xlsx';
        Excel::store(new TemplateExport($templateData, $headings), $filePath, 'local', ExcelWriter::XLSX);

        return Storage::download($filePath);
    }
}
