<?php

namespace App\Filament\Resources\RelawanResource\Pages;

use App\Filament\Resources\RelawanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;
use Illuminate\Support\Facades\Validator;
use App\Models\DPT;
use App\Models\Relawan;

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
                    ImportField::make('nik')
                        ->required()
                        ->label('NIK'),
                    ImportField::make('no_hp')
                        ->required()
                        ->label('No HP'),
                    ImportField::make('recommander')
                        ->required()
                        ->label('Recommander'),
                    ImportField::make('anggota_dewan')
                        ->required()
                        ->label('Anggota Dewan'),
                    ImportField::make('operator')
                        ->required()
                        ->label('Operator'),
                    ImportField::make('organisasi')
                        ->required()
                        ->label('Organisasi'),
                    ImportField::make('jabatan')
                        ->required()
                        ->label('Jabatan'),
                    ImportField::make('sk')
                        ->required()
                        ->label('SK'),
                    ImportField::make('status_nik')
                        ->required()
                        ->label('Status NIK'),
                ])
                ->handleRecordCreation(function(array $data) {
                    return Relawan::create([
                        'nik' => $data['nik'],
                        'no_hp' => $data['no_hp'],
                        'recommander' => $data['recommander'],
                        'anggota_dewan' => $data['anggota_dewan'],
                        'operator' => $data['operator'],
                        'organisasi' => $data['organisasi'],
                        'jabatan' => $data['jabatan'],
                        'sk' => $data['sk'],
                        'status_nik' => $data['status_nik'],
                    ]);
                }),
        ];
    }
}
