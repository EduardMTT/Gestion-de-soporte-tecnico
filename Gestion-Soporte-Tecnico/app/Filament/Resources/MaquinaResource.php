<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaquinaResource\Pages;
use App\Models\Maquina;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\DateColumn;

class MaquinaResource extends Resource
{
    protected static ?string $model = Maquina::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?string $navigationLabel = 'Máquinas';
    protected static ?string $modelLabel = 'Máquina';
    protected static ?string $pluralModelLabel = 'Máquinas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('propietario')
                    ->label('Propietario')
                    ->required()
                    ->maxLength(255),

                TextInput::make('marca')
                    ->label('Marca')
                    ->required()
                    ->maxLength(255),

                TextInput::make('modelo')
                    ->label('Modelo')
                    ->required()
                    ->maxLength(255),

                Textarea::make('descripcion')
                    ->label('Descripción')
                    ->rows(3)
                    ->maxLength(1000),

                DatePicker::make('fecha_de_adquisicion')
                    ->label('Fecha de Adquisición')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('propietario')->label('Propietario')->searchable(),
                TextColumn::make('marca')->label('Marca')->searchable(),
                TextColumn::make('modelo')->label('Modelo')->searchable(),
                TextColumn::make('descripcion')->label('Descripción')->limit(30),
                TextColumn::make('fecha_de_adquisicion')->label('Fecha de Adquisición')->date('d/m/Y'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMaquinas::route('/'),
            'create' => Pages\CreateMaquina::route('/create'),
            'edit' => Pages\EditMaquina::route('/{record}/edit'),
        ];
    }
}
