<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DPTResource\Pages;
use App\Filament\Resources\DPTResource\RelationManagers;
use App\Models\DPT;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Webbingbrasil\FilamentAdvancedFilter\Filters\TextFilter;

class DPTResource extends Resource
{
    protected static ?string $model = DPT::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama')
                    ->required(),
                Forms\Components\TextInput::make('nik')
                    ->label('NIK')
                    ->required()
                    ->unique('dpt', 'nik') // Ensure NIK is unique in the dpt table
                    ->rule('exists:dpt,nik'),
                Forms\Components\TextInput::make('kelurahan')
                    ->label('Kelurahan')
                    ->required(),
                Forms\Components\TextInput::make('kecamatan')
                    ->label('Kecamatan')
                    ->required(),
                Forms\Components\TextInput::make('alamat')
                    ->label('Alamat')
                    ->required(),
                Forms\Components\TextInput::make('rt')
                    ->label('RT')
                    ->required(),
                Forms\Components\TextInput::make('rw')
                    ->label('RW')
                    ->required(),
                Forms\Components\TextInput::make('tps')
                    ->label('TPS')
                    ->required(),
                Forms\Components\Select::make('kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama'),
                Tables\Columns\TextColumn::make('nik')->label('NIK'),
                Tables\Columns\TextColumn::make('kelurahan')->label('Kelurahan'),
                Tables\Columns\TextColumn::make('kecamatan')->label('Kecamatan'),
                Tables\Columns\TextColumn::make('alamat')->label('Alamat'),
                Tables\Columns\TextColumn::make('rt')->label('RT'),
                Tables\Columns\TextColumn::make('rw')->label('RW'),
                Tables\Columns\TextColumn::make('tps')->label('TPS'),
                Tables\Columns\TextColumn::make('kelamin')->label('Jenis Kelamin'),
            ])
            ->filters([
                TextFilter::make('nik')
                    ->label('NIK'),
                TextFilter::make('nama')
                    ->label('Nama'),
                TextFilter::make('kelurahan')
                    ->label('Kelurahan'),
                TextFilter::make('kecamatan')
                    ->label('Kecamatan'),
                TextFilter::make('alamat')
                    ->label('Alamat'),

            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListDPTS::route('/'),
            'create' => Pages\CreateDPT::route('/create'),
            'edit' => Pages\EditDPT::route('/{record}/edit'),
        ];
    }
}
