<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MantenimientoResource\Pages;
use App\Models\Mantenimiento;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Button;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Carbon\Carbon;

class MantenimientoResource extends Resource
{
    protected static ?string $model = Mantenimiento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Mantenimientos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('tecnico_id')
                    ->label('Técnico')
                    ->relationship('tecnico', 'nombre')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('maquina_id')
                    ->label('Máquina')
                    ->relationship('maquina', 'propietario')
                    ->searchable()
                    ->preload()
                    ->required(),

                MultiSelect::make('piezas')
                    ->label('Piezas a utilizar')
                    ->relationship('piezas', 'nombre')
                    ->searchable()
                    ->preload()
                    ->required(),

                DatePicker::make('fecha_programada')
                    ->label('Fecha Programada')
                    ->required(),

                Fieldset::make('Horario')
                    ->schema([
                        TimePicker::make('hora_inicio')
                            ->label('Hora Inicio')
                            ->withoutSeconds()
                            ->required(),
                        TimePicker::make('hora_fin')
                            ->label('Hora Fin')
                            ->withoutSeconds()
                            ->required(),
                    ]),

                Textarea::make('descripcion')
                    ->label('Descripción')
                    ->rows(4)
                    ->maxLength(1000),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tecnico.nombre')
                    ->label('Técnico')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('maquina.propietario')
                    ->label('Propietario')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('fecha_programada')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('hora_inicio')
                    ->label('Inicio')
                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('H:i'))
                    ->sortable(),

                TextColumn::make('hora_fin')
                    ->label('Fin')
                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('H:i'))
                    ->sortable(),

                TextColumn::make('duracion')
                    ->label('Duracion (horas)')
                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('H:i'))
                    ->sortable(),

                TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->limit(50),

                TextColumn::make('piezas_count')
                    ->label('Piezas')
                    ->counts('piezas'),
            ])
            ->filters([])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
                
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMantenimientos::route('/'),
        ];
    }
}
