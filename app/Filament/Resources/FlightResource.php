<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlightResource\Pages;
use App\Filament\Resources\FlightResource\RelationManagers;
use App\Models\Flight;
use App\Models\Passenger;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class FlightResource extends Resource
{
    protected static ?string $model = Flight::class;

    protected static ?string $navigationIcon = 'heroicon-o-chevron-double-up';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('number')->required(),
                Forms\Components\BelongsToSelect::make('airplane_id')->relationship('airplane', 'typ'),
                Forms\Components\DateTimePicker::make('departure_date')->required(),
                Forms\Components\DateTimePicker::make('arrival_date')->required(),
                Forms\Components\BelongsToSelect::make('start_airport_id')->relationship('start', 'short_name'),
                Forms\Components\BelongsToSelect::make('end_airport_id')->relationship('end', 'short_name'),
                Forms\Components\Toggle::make('is_ready'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number'),
                Tables\Columns\TextColumn::make('airplane.typ'),
                Tables\Columns\TextColumn::make('start.short_name'),
                Tables\Columns\TextColumn::make('end.short_name'),
                Tables\Columns\BooleanColumn::make('ready')
                    ->action('toggleReady'),
            ])
            ->filters([

            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PassengersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFlights::route('/'),
            'create' => Pages\CreateFlight::route('/create'),
            'edit' => Pages\EditFlight::route('/{record}/edit'),
        ];
    }
}
