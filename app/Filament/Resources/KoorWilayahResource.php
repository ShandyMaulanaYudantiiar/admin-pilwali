<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KoorWilayahResource\Pages;
use App\Filament\Resources\KoorWilayahResource\RelationManagers;
use App\Models\KoorWilayah;
use App\Models\Kecamatan;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KoorWilayahResource extends Resource
{
    protected static ?string $model = KoorWilayah::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kecamatan_id')
                    ->label('Kecamatan')
                    ->options(Kecamatan::all()->pluck('nama_kecamatan', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('nama_koor_wilayah')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kecamatan.nama_kecamatan')->label('Kecamatan'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('nama_koor_wilayah'),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime(),
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
            'index' => Pages\ListKoorWilayahs::route('/'),
            'create' => Pages\CreateKoorWilayah::route('/create'),
            'edit' => Pages\EditKoorWilayah::route('/{record}/edit'),
        ];
    }
}
