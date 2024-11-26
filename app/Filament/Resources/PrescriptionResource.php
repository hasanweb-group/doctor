<?php

namespace App\Filament\Resources;

use App\Enums\Localization;
use App\Filament\Resources\PrescriptionResource\Pages;
use App\Filament\Resources\PrescriptionResource\RelationManagers;
use App\Filament\Resources\PrescriptionResource\RelationManagers\PrescriptionInformationRelationManager;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Prescription;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrescriptionResource extends Resource
{
    protected static ?string $model = Prescription::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return __(Localization::Prescription->value . '.title');
    }

    public static function getModelLabel(): string
    {
        return __(Localization::Prescription->value . '.prescription');
    }

    public static function getPluralModelLabel(): string
    {
        return __(Localization::Prescription->value . '.title');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Grid::make(2)->schema([

                        Select::make('doctor_id')
                            ->label(Localization::Doctor->value . '.doctor')
                            ->translateLabel()
                            ->native(false)
                            ->options(fn() => PrescriptionResource::getDoctors()),

                        Select::make('patient_id')
                            ->label(Localization::Patient->value . '.patient')
                            ->native(false)
                            ->translateLabel()
                            ->options(fn() => PrescriptionResource::getPatients())
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.full_name')
                    ->label(Localization::Patient->value . '.patient')
                    ->translateLabel()
                    ->sortable(),

                TextColumn::make('doctor.full_name')
                    ->label(Localization::Doctor->value . '.doctor')
                    ->translateLabel()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PrescriptionInformationRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrescriptions::route('/'),
            'create' => Pages\CreatePrescription::route('/create'),
            'edit' => Pages\EditPrescription::route('/{record}/edit'),
        ];
    }

    public static function getPatients(): array
    {
        return Patient::all()->mapWithKeys(fn($patient) => [$patient->id => $patient->full_name])->toArray();
    }

    public static function getDoctors(): array
    {
        return Doctor::all()->mapWithKeys(fn($doctor) => [$doctor->id => $doctor->full_name])->toArray();
    }
}
