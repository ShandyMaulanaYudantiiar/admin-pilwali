<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RelawanResource\Pages;
use App\Filament\Resources\RelawanResource\RelationManagers;
use App\Models\Relawan;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RelawanResource extends Resource
{
    protected static ?string $model = Relawan::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nik')
                    ->label('NIK')
                    ->required()
                    ->unique('relawans', 'nik') // Ensure NIK is unique in the relawans table
                    ->rule('exists:dpt,nik'),
                Forms\Components\TextInput::make('no_hp')
                    ->label('No HP'),
                Forms\Components\TextInput::make('recommander')
                    ->label('Recommander'),
                Forms\Components\TextInput::make('anggota_dewan')
                    ->label('Anggota Dewan'),
                Forms\Components\TextInput::make('operator')
                    ->label('Operator'),
                Forms\Components\TextInput::make('organisasi')
                    ->label('Organisasi'),
                Forms\Components\TextInput::make('jabatan')
                    ->label('Jabatan'),
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
                Tables\Columns\TextColumn::make('nik')->label('NIK'),
                Tables\Columns\TextColumn::make('dpt.nama')->label('Nama'),
                Tables\Columns\TextColumn::make('no_hp')->label('No HP'),
                Tables\Columns\TextColumn::make('recommander')->label('Recommander'),
                Tables\Columns\TextColumn::make('anggota_dewan')->label('Anggota Dewan'),
                Tables\Columns\TextColumn::make('operator')->label('Operator'),
                Tables\Columns\TextColumn::make('organisasi')->label('Organisasi'),
                Tables\Columns\TextColumn::make('jabatan')->label('Jabatan'),
                Tables\Columns\TextColumn::make('sk')->label('SK'),
                Tables\Columns\TextColumn::make('status_nik')->label('Status NIK'),
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
