<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PassengerFieldResource\Pages;
use App\Filament\Resources\PassengerFieldResource\RelationManagers;
use App\Models\PassengerField;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class PassengerFieldResource extends Resource
{
    protected static ?string $model = PassengerField::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                Forms\Components\TextInput::make('short_name'),
                Forms\Components\Select::make('typ')->options(
                    [
                        'number'=>'Nummer',
                        'text'=>'Text',
                    ]
                ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('short_name'),
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
            'index' => Pages\ListPassengerFields::route('/'),
            'create' => Pages\CreatePassengerField::route('/create'),
            'edit' => Pages\EditPassengerField::route('/{record}/edit'),
        ];
    }
}
