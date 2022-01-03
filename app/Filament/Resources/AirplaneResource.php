<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AirplaneResource\Pages;
use App\Filament\Resources\AirplaneResource\RelationManagers;
use App\Models\Airplane;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class AirplaneResource extends Resource
{
    protected static ?string $model = Airplane::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('typ')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('typ'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListAirplanes::route('/'),
            'create' => Pages\CreateAirplane::route('/create'),
            'edit' => Pages\EditAirplane::route('/{record}/edit'),
        ];
    }
}
