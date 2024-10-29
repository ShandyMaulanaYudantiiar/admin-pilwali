<?php

namespace App\Filament\Resources\DPTResource\Pages;

use App\Filament\Resources\DPTResource;
use App\Models\DPT;
use App\Models\KoorWilayah;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class ListDPTS extends ListRecords
{
    protected static string $resource = DPTResource::class;

    protected function getActions(): array
    {
        return [
            ImportAction::make()
                ->uniqueField('nik')
                ->fields([
                    ImportField::make('nama')
                        ->required()
                        ->label('Nama'),
                    ImportField::make('nik')
                        ->required()
                        ->label('NIK'),
                    ImportField::make('kelurahan')
                        ->required()
                        ->label('Kelurahan'),
                    ImportField::make('kecamatan')
                        ->required()
                        ->label('Kecamatan'),
                    ImportField::make('alamat')
                        ->required()
                        ->label('Alamat'),
                    ImportField::make('rt')
                        ->required()
                        ->label('RT'),
                    ImportField::make('rw')
                        ->required()
                        ->label('RW'),
                    ImportField::make('tps')
                        ->required()
                        ->label('TPS'),
                    ImportField::make('kelamin')
                        ->required()
                        ->label('Kelamin'),
                ])
                ->handleRecordCreation(function(array $data) {
                    return DPT::create([
                        'nama' => $data['nama'],
                        'nik' => $data['nik'],
                        'kelurahan' => $data['kelurahan'],
                        'kecamatan' => $data['kecamatan'],
                        'alamat' => $data['alamat'],
                        'rt' => $data['rt'],
                        'rw' => $data['rw'],
                        'tps' => (string) $data['tps'],
                        'kelamin' => $data['kelamin'],
                    ]);
                }),
        ];
    }
}
