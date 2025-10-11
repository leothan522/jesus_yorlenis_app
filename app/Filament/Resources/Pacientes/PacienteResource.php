<?php

namespace App\Filament\Resources\Pacientes;

use App\Filament\Resources\Pacientes\Pages\ManagePacientes;
use App\Models\Paciente;
use BackedEnum;
use Carbon\Carbon;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PacienteResource extends Resource
{
    protected static ?string $model = Paciente::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $recordTitleAttribute = 'cedula';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos Básicos')
                    ->schema([
                        TextInput::make('cedula')
                            ->label('Cédula')
                            ->integer()
                            ->minLength(6)
                            ->maxLength(15)
                            ->unique()
                            ->required(),
                        TextInput::make('nombre')
                            ->label('Nombre y Apellido')
                            ->maxLength(255)
                            ->required()
                            ->columnSpan(2),
                        DatePicker::make('fecha_nacimiento')
                            ->label('Fecha de Nacimiento')
                            ->live(onBlur: true)
                            ->partiallyRenderComponentsAfterStateUpdated(['edad'])
                            ->afterStateUpdated(function (Get $get, Set $set): void {
                                if (!empty($get('fecha_nacimiento'))) {
                                    $edad = Carbon::create($get('fecha_nacimiento'))->age;
                                    $set('edad', $edad);
                                }
                            }),
                        TextInput::make('edad')
                            ->integer()
                            ->minValue(0)
                            ->requiredWithout('fecha_nacimiento')
                            ->readOnly(fn(Get $get): bool => !empty($get('fecha_nacimiento'))),
                        TextInput::make('telefono')
                            ->label('Teléfono')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                        Textarea::make('direccion')
                            ->label('Dirección')
                            ->columnSpanFull()
                    ])
                    ->compact()
                    ->columns(3)
                    ->columnSpanFull(),
                Section::make('Datos Médicos')
                    ->schema([
                        DatePicker::make('fur')
                            ->label('FUR'),
                        DatePicker::make('fpp')
                            ->label('FPP'),
                        TextInput::make('gestas')
                            ->integer()
                            ->minValue(0),
                        TextInput::make('partos')
                            ->integer()
                            ->minValue(0),
                        TextInput::make('cesareas')
                            ->integer()
                            ->minValue(0),
                        TextInput::make('abortos')
                            ->integer()
                            ->minValue(0),
                    ])
                    ->compact()
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('cedula')
            ->columns([
                TextColumn::make('paciente')
                    ->numeric()
                    ->default(fn(Paciente $record): string => $record->cedula)
                    ->description(fn(Paciente $record): string => $record->nombre)
                    ->hiddenFrom('md'),
                TextColumn::make('cedula')
                    ->label('Cédula')
                    ->numeric()
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('nombre')
                    ->label('Nombre y Apellido')
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('fecha_nacimiento')
                    ->label('Fecha Nac.')
                    ->date('d/m/Y')
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('edad')
                    ->numeric()
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('telefono')
                    ->label('Teléfono')
                    ->searchable()
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->visibleFrom('md'),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->visibleFrom('md'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                    ForceDeleteAction::make(),
                    RestoreAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePacientes::route('/'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
