<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PassengerResource\Pages;
use App\Filament\Resources\PassengerResource\RelationManagers;
use App\Models\Passenger;
use App\Models\PassengerField;
use App\Models\PassengerValue;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class PassengerResource extends Resource
{
    protected static ?string $model = Passenger::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        $fields[] = Forms\Components\TextInput::make('email')->required();

        foreach (PassengerField::get() as $passengerField){
            if($passengerField->typ == 'number'){
                $fields[] = Forms\Components\TextInput::make($passengerField->short_name)
                    ->required()
                    ->numeric()
                    ->label($passengerField->name)
                    ->afterStateHydrated(function (TextInput $component, $state) use ($passengerField) {
                        $passengerValue = PassengerValue::where('passenger_id',1)
                            ->where('passenger_field_id',$passengerField->id)
                            ->first();
                        $component->state($passengerValue->value);
                    });
            }
            if($passengerField->typ == 'text'){
                $fields[] = Forms\Components\TextInput::make($passengerField->short_name)
                    ->required()
                    ->label($passengerField->name);
            }
        }

        return $form
            ->schema(
                $fields
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email'),
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
            'index' => Pages\ListPassengers::route('/'),
            'create' => Pages\CreatePassenger::route('/create'),
            'edit' => Pages\EditPassenger::route('/{record}/edit'),
        ];
    }
}
