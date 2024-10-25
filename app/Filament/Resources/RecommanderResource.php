<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecommanderResource\Pages;
use App\Filament\Resources\RecommanderResource\RelationManagers;
use App\Models\AnggotaDewan;
use App\Models\Recommander;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RecommanderResource extends Resource
{
    protected static ?string $model = Recommander::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('anggota_dewan_id')
                    ->label('Anggota Dewan')
                    ->options(AnggotaDewan::all()->pluck('nama_anggota_dewan', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('nama_recommander')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('anggotaDewan.nama_anggota_dewan')->label('Anggota Dewan'),
                Tables\Columns\TextColumn::make('nama_recommander'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListRecommanders::route('/'),
            'create' => Pages\CreateRecommander::route('/create'),
            'edit' => Pages\EditRecommander::route('/{record}/edit'),
        ];
    }
}
