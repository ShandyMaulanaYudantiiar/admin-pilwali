<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RelawanResource\Pages;
use App\Models\Relawan;
use App\Models\KoorWilayah;
use App\Models\Kecamatan;
use App\Models\Jabatan;
use App\Models\Recommander;
use App\Models\AnggotaDewan;
use App\Models\Operator;
use App\Models\Organisasi;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class RelawanResource extends Resource
{
    protected static ?string $model = Relawan::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_relawan')
                    ->label('Nama Relawan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nik')
                    ->label('NIK')
                    ->required()
                    ->unique()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tempat_lahir')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->required(),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('rt')
                    ->label('RT')
                    ->required()
                    ->maxLength(3),
                Forms\Components\TextInput::make('rw')
                    ->label('RW')
                    ->required()
                    ->maxLength(3),
                Forms\Components\TextInput::make('no_hp')
                    ->required()
                    ->maxLength(15),
                Forms\Components\Select::make('id_kecamatan')
                    ->label('Kecamatan')
                    ->options(Kecamatan::all()->pluck('nama_kecamatan', 'id'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set) {
                        $set('koor_wilayah_id', null);
                    }),
                Forms\Components\Select::make('koor_wilayah_id')
                    ->label('Koor Wilayah')
                    ->options(function (callable $get) {
                        $kecamatanId = $get('id_kecamatan');
                        if ($kecamatanId) {
                            return KoorWilayah::where('kecamatan_id', $kecamatanId)->pluck('nama_koor_wilayah', 'id');
                        }
                        return [];
                    })
                    ->required(),
                Forms\Components\Select::make('jabatan_id')
                    ->label('Jabatan')
                    ->options(Jabatan::all()->pluck('nama_jabatan', 'id'))
                    ->required(),
                Forms\Components\Select::make('operator_id')
                    ->label('Operator')
                    ->options(Operator::all()->pluck('nama_operator', 'id'))
                    ->required(),
                Forms\Components\Select::make('anggota_dewan_id')
                    ->label('Anggota Dewan')
                    ->options(AnggotaDewan::all()->pluck('nama_anggota_dewan', 'id'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set) {
                        $set('recommander_id', null);
                    }),
                Forms\Components\Select::make('recommander_id')
                    ->label('Recommander')
                    ->options(function (callable $get) {
                        $anggotaDewanId = $get('anggota_dewan_id');
                        if ($anggotaDewanId) {
                            return Recommander::where('anggota_dewan_id', $anggotaDewanId)->pluck('nama_recommander', 'id');
                        }
                        return [];
                    })
                    ->required(),
                Forms\Components\TextInput::make('tps')
                    ->label('TPS')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('organisasi_id')
                    ->label('Organisasi')
                    ->options(Organisasi::all()->pluck('nama_organisasi', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('sk')
                    ->label('SK')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status_nik')
                    ->label('Status NIK')
                    ->options([
                        'NIK VALID' => 'NIK VALID',
                        'NIK TIDAK VALID' => 'NIK TIDAK VALID',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_relawan')->label('Nama Relawan'),
                Tables\Columns\TextColumn::make('nik')->label('NIK'),
                Tables\Columns\TextColumn::make('tempat_lahir')->label('Tempat Lahir'),
                Tables\Columns\TextColumn::make('tanggal_lahir')->label('Tanggal Lahir')->date(),
                Tables\Columns\TextColumn::make('alamat')->label('Alamat'),
                Tables\Columns\TextColumn::make('rt')->label('RT'),
                Tables\Columns\TextColumn::make('rw')->label('RW'),
                Tables\Columns\TextColumn::make('koorWilayah.nama_koor_wilayah')->label('Koor Wilayah'),
                Tables\Columns\TextColumn::make('kecamatan.nama_kecamatan')->label('Kecamatan'),
                Tables\Columns\TextColumn::make('no_hp')->label('No HP'),
                Tables\Columns\TextColumn::make('jabatan.nama_jabatan')->label('Jabatan'),
                Tables\Columns\TextColumn::make('recommander.nama_recommander')->label('Recommander'),
                Tables\Columns\TextColumn::make('anggotaDewan.nama_anggota_dewan')->label('Anggota Dewan'),
                Tables\Columns\TextColumn::make('operator.nama_operator')->label('Operator'),
                Tables\Columns\TextColumn::make('tps')->label('TPS'),
                Tables\Columns\TextColumn::make('organisasi.nama_organisasi')->label('Organisasi'),
                Tables\Columns\TextColumn::make('sk')->label('SK'),
                Tables\Columns\TextColumn::make('status_nik')->label('Status NIK'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRelawans::route('/'),
            'create' => Pages\CreateRelawan::route('/create'),
            'edit' => Pages\EditRelawan::route('/{record}/edit'),
        ];
    }
}
