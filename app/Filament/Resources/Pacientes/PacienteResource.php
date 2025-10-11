<?php

namespace App\Filament\Resources\Pacientes;

use App\Filament\Resources\Pacientes\Pages\ManagePacientes;
use App\Models\Paciente;
use BackedEnum;
use Carbon\Carbon;
use Filament\Actions\Action;
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
use Filament\Infolists\Components\TextEntry;
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
use Illuminate\Support\Str;

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
                    ->columnSpanFull()
                    ->collapsible(),
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
                    ->columnSpanFull()
                    ->collapsible(),
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
                    ->description(fn(Paciente $record): string => Str::upper($record->nombre))
                    ->wrap()
                    ->hiddenFrom('md'),
                TextColumn::make('cedula')
                    ->label('Cédula')
                    ->numeric()
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('nombre')
                    ->label('Nombre y Apellido')
                    ->formatStateUsing(fn(string $state): string => Str::upper($state))
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
                    ViewAction::make()
                        ->modalHeading(fn(Paciente $record): string => 'Vista de ' . formatoMillares($record->cedula, 0))
                        ->modalDescription(fn(Paciente $record): string => Str::upper($record->nombre))
                        ->extraModalFooterActions([
                            EditAction::make()
                                ->modalHeading(fn(Paciente $record): string => 'Editar ' . formatoMillares($record->cedula, 0))
                                ->modalDescription(fn(Paciente $record): string => Str::upper($record->nombre))
                        ]),
                    EditAction::make()
                        ->modalHeading(fn(Paciente $record): string => 'Editar ' . formatoMillares($record->cedula, 0))
                        ->modalDescription(fn(Paciente $record): string => Str::upper($record->nombre))
                    ,
                    DeleteAction::make()
                    ->modalHeading(fn(Paciente $record): string => 'Borrar '.formatoMillares($record->cedula, 0)),
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
                Action::make('actualizar')
                    ->icon(Heroicon::ArrowPath)
                    ->iconButton(),
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

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos Básicos')
                    ->schema([
                        TextEntry::make('cedula')
                            ->label('Cédula')
                            ->getStateUsing(fn(Paciente $record): ?string => Paciente::find($record->id)?->cedula)
                            ->numeric()
                            ->color('primary')
                            ->copyable(),
                        TextEntry::make('nombre')
                            ->label('Nombre y Apellido')
                            ->getStateUsing(fn(Paciente $record): ?string => Paciente::find($record->id)?->nombre)
                            ->formatStateUsing(fn(string $state): string => Str::upper($state))
                            ->color('primary')
                            ->columnSpan(2)
                            ->copyable(),
                        TextEntry::make('fecha_nacimiento')
                            ->label('Fecha Nac.')
                            ->getStateUsing(fn(Paciente $record): ?string => Paciente::find($record->id)?->fecha_nacimiento)
                            ->date('d/m/Y')
                            ->color('primary')
                            ->copyable(),
                        TextEntry::make('edad')
                            ->getStateUsing(fn(Paciente $record): ?string => Paciente::find($record->id)?->edad)
                            ->numeric()
                            ->color('primary')
                            ->copyable(),
                        TextEntry::make('telefono')
                            ->label('Teléfono')
                            ->getStateUsing(fn(Paciente $record): ?string => Paciente::find($record->id)?->telefono)
                            ->color('primary')
                            ->copyable(),
                        TextEntry::make('direccion')
                            ->label('Dirección')
                            ->getStateUsing(fn(Paciente $record): ?string => Paciente::find($record->id)?->direccion)
                            ->formatStateUsing(fn(string $state): string => Str::upper($state))
                            ->color('primary')
                            ->columnSpanFull()
                            ->copyable()
                    ])
                    ->compact()
                    ->columns(3)
                    ->collapsible(),
                Section::make('Datos Médicos')
                    ->schema([
                        TextEntry::make('fur')
                            ->label('FUR')
                            ->getStateUsing(fn(Paciente $record): ?string => Paciente::find($record->id)?->fur)
                            ->date()
                            ->color('primary'),
                        TextEntry::make('fpp')
                            ->label('FPP')
                            ->getStateUsing(fn(Paciente $record): ?string => Paciente::find($record->id)?->fpp)
                            ->date()
                            ->color('primary'),
                        TextEntry::make('gestas')
                            ->getStateUsing(fn(Paciente $record): ?string => Paciente::find($record->id)?->gestas)
                            ->numeric()
                            ->color('primary'),
                        TextEntry::make('partos')
                            ->getStateUsing(fn(Paciente $record): ?string => Paciente::find($record->id)?->partos)
                            ->numeric()
                            ->color('primary'),
                        TextEntry::make('cesareas')
                            ->getStateUsing(fn(Paciente $record): ?string => Paciente::find($record->id)?->cesareas)
                            ->numeric()
                            ->color('primary'),
                        TextEntry::make('abortos')
                            ->getStateUsing(fn(Paciente $record): ?string => Paciente::find($record->id)?->abortos)
                            ->numeric()
                            ->color('primary'),
                    ])
                    ->compact()
                    ->columns(3)
                    ->collapsible()
            ]);
    }

}
