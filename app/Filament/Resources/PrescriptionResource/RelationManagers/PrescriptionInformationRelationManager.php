<?php

namespace App\Filament\Resources\PrescriptionResource\RelationManagers;

use App\Enums\Localization;
use App\Models\Drug;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrescriptionInformationRelationManager extends RelationManager
{
    protected static string $relationship = 'prescriptionInformation';


    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __(Localization::PrescriptionInformation->value . '.title');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('drug_id')
                    ->native(false)
                    ->options(fn() => $this->getDrugs())
                    ->label(Localization::Drug->value . '.name')
                    ->translateLabel()
                    ->columnSpan('full')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__(Localization::PrescriptionInformation->value . '.empty'))
            ->emptyStateDescription(__(Localization::PrescriptionInformation->value . '.empty_description'))
            ->columns([
                TextColumn::make('drug.name')
                    ->label(Localization::Drug->value . '.name')
                    ->translateLabel(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label(__(Localization::PrescriptionInformation->value . '.create'))
                    ->modalWidth('sm')
                    ->modalHeading(__(Localization::PrescriptionInformation->value . '.create')),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading(__(Localization::PrescriptionInformation->value . '.edit'))
                    ->modalWidth('sm')
                    ->modalDescription(fn($record) => __(Localization::PrescriptionInformation->value . '.edit_description', ['drug' => $record->drug->name])),

                Tables\Actions\DeleteAction::make()
                    ->modalHeading(fn($record) => __(Localization::PrescriptionInformation->value . '.delete', ['drug' => $record->drug->name]))
                    ->modalWidth('sm')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function getDrugs()
    {
        return Drug::query()
            ->get()
            ->mapWithKeys(fn(Drug $drug) => [$drug->getKey() => $drug->name])
        ;
    }
}
